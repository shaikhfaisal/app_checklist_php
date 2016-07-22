<?php

namespace FS\StorageAdaptors;

use FS\Models\CheckList;
use FS\Models\CheckListItem;
use FS\Models\StandardModel;

/**
 * Class CheckListAdaptor
 * @package FS\StorageAdaptors
 */
class CheckListDatabaseAdaptor
{

    /**
     * @type \PDO
     */
    private $dsn;

    /**
     * CheckListAdaptor constructor.
     */
    public function __construct()
    {
        $this->dsn = new \PDO("pgsql:dbname=checklists;host=127.0.0.1", "checklists", "checklists");
    }

    /**
     * Saves the model to storage
     *
     * @param StandardModel $checklist_model
     * @return null
     */
    public function create(CheckList $checklist_model)
    {

        $sth = $this->dsn->prepare("INSERT INTO lists (name) VALUES (:name)");
        $sth->execute(
            [
                ":name" => $checklist_model->getName(),
            ]
        );

    }

    /**
     * Hydrates a model object from the database.
     *
     * @param $list_id
     * @param CheckList $list
     */
    public function hydrate($list_id, CheckList $list)
    {
        $sth = $this->dsn->prepare("SELECT id, name from lists where id=:list_id");
        $sth->execute(
            [
                ":list_id" => $list_id,
            ]
        );

        $result = $sth->fetch(\PDO::FETCH_ASSOC);

        $list->setId($result["id"]);
        $list->setName($result["name"]);

        $sth = $this->dsn->prepare("SELECT id, name from list_items where list_id=:list_id");
        $sth->execute(
            [
                ":list_id" => $list_id,
            ]
        );

        while ($result = $sth->fetch(\PDO::FETCH_ASSOC)) {

            $list_item = new CheckListItem(null, new CheckListItemDatabaseAdaptor);
            $list_item->setId($result["id"]);
            $list_item->setName($result["name"]);

            $list->addCheckListItem($list_item, false);

        }

    }

    /**
     * Persists the addition of a checklist item to the database
     *
     * @param CheckList $list
     * @param CheckListItem $list_item
     */
    public function addCheckListItem(CheckList $list, CheckListItem $list_item)
    {
        $sth = $this->dsn->prepare("INSERT INTO list_items (list_id, name) VALUES (:list_id, :name)");
        $sth->execute(
            [
                ":list_id" => $list->getId(),
                ":name"    => $list_item->getName(),
            ]
        );

    }

    public function removeCheckListItem(CheckList $item, CheckListItem $list_item)
    {
        $sth = $this->dsn->prepare("DELETE FROM list_items WHERE id = :list_item_id");
        $sth->execute(
            [
                ":list_item_id" => $list_item->getId(),
            ]
        );
    }
}