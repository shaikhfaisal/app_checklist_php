<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use FS\Models\CheckList;
use FS\Models\Adaptors\CheckList as CheckListAdaptor;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
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
     * @Given I have a list called :arg1
     */
    public function iHaveAListCalled($list_name)
    {
        $list = new Checklist(new CheckListAdaptor());
        $list->setName($list_name)->save();

    }

    /**
     * @Given I add :arg1 to :arg2 list
     */
    public function iAddToList($list_item_name, $list_name)
    {
        $sth = $this->dsn->prepare("SELECT id from lists where name=:name");
        $sth->execute(
            [
                ":name" => $list_name,
            ]
        );
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        $list_id = $result["id"];

        $sth = $this->dsn->prepare("INSERT INTO list_items (list_id, name) VALUES (:list_id, :list_item_name)");
        $sth->execute(
            [
                ":list_id" => $list_id,
                ":list_item_name" => $list_item_name
            ]
        );
    }

    /**
     * @Then I should have :no_of_items items in the :list_name list
     */
    public function iShouldHaveItemsInTheList($no_of_items, $list_name)
    {
        $sth = $this->dsn->prepare("SELECT id from lists where name=:name");
        $sth->execute(
            [
                ":name" => $list_name,
            ]
        );
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        $list_id = $result["id"];

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



}
