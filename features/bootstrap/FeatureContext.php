<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use FS\Services\CheckListService;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * @var object PDO
     */
    protected $dsn;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->dsn = new \PDO("pgsql:dbname=checklists;host=127.0.0.1", "checklists", "checklists");
    }


    /**
     * @Given I have a list called :list_name
     */
    public function iHaveAListCalled($list_name)
    {
        $service = new CheckListService();
        $service->createList($list_name);
    }

    /**
     * @When I create a list called :list_name
     */
    public function iCreateAListCalled($list_name)
    {
        $this->iHaveAListCalled($list_name);
    }


    /**
     * @Given I add :list_item_name to :list_name list
     */
    public function iAddToList($list_item_name, $list_name)
    {

        $list_id = $this->getIdOfList($list_name);

        $service = new CheckListService();
        $service->addItemToList($list_id, $list_item_name);

    }

    /**
     * Returns the id of a list identified by a name
     *
     * @param $list_name
     * @return integer
     */
    private function getIdOfList($list_name)
    {
        $sth = $this->dsn->prepare("SELECT id from lists where name=:name");
        $sth->execute(
            [
                ":name" => $list_name,
            ]
        );
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result["id"];
    }

    /**
     * @Then I should have :no_of_items items in the :list_name list
     */
    public function iShouldHaveItemsInTheList($no_of_items, $list_name)
    {

        $list_id = $this->getIdOfList($list_name);

        $sth = $this->dsn->prepare("SELECT count(1) from list_items where list_id=:list_id");
        $sth->execute(
            [
                ":list_id" => $list_id,
            ]
        );
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        $count = $result["count"];

        assert($count == $no_of_items);

    }


    /**
     * @Given I remove an item :item_name from the :list_name list
     */
    public function iRemoveAnItemFromTheList($item_name, $list_name)
    {
        $list_id = $this->getIdOfList($list_name);

        $service = new CheckListService();
        $service->removeItemFromList($list_id, $item_name);

    }

    /**
     * @Then I should not have :arg1 in the :arg2 list
     */
    public function iShouldNotHaveInTheList($item_name, $list_name)
    {

        $list_id = $this->getIdOfList($list_name);

        $sth = $this->dsn->prepare("SELECT count(1) from list_items where list_id=:list_id AND name=:item_name");
        $sth->execute(
            [
                ":list_id" => $list_id,
                ":item_name" => $item_name,
            ]
        );

        $result = $sth->fetch(PDO::FETCH_ASSOC);
        $count = $result["count"];

        assert($count == 0);

    }

    /**
     * @Then I should have :arg1 in the :arg2 list
     */
    public function iShouldHaveInTheList($item_name, $list_name)
    {

        $list_id = $this->getIdOfList($list_name);
        $service = new CheckListService();
        $no_of_matches = 0;

        /** @type \FS\Models\CheckList $check_list */
        /** @type \FS\Models\CheckListItem $check_list_item */
        $check_list = $service->retrieveList($list_id);
        foreach ($check_list->getListItems() as $check_list_item) {
            if ($check_list_item->getName() == $item_name) {
                $no_of_matches++;
            }
        }

        assert($no_of_matches > 0);

    }

}
