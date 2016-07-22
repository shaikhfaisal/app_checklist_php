<?php

namespace FS\StorageAdaptors;

use FS\Models\CheckList;
use FS\Models\CheckListItem;
use FS\Models\StandardModel;

/**
 * Class CheckListItemAdaptor
 * @package FS\StorageAdaptors
 */
class CheckListItemDatabaseAdaptor
{
    /**
     * @type object \PDO
     */
    private $dsn;

    /**
     * CheckListItemAdaptor constructor.
     */
    public function __construct()
    {
        $this->dsn = new \PDO("pgsql:dbname=checklists;host=127.0.0.1", "checklists", "checklists");
    }

    /**
     * Hydrates a model object from the database.
     *
     * @param $list_id
     * @param CheckList $list
     */
    public function hydrate($list_item_id, CheckListItem $list_item)
    {
        $sth = $this->dsn->prepare("SELECT id, name from list_items where id=:list_item_id");
        $sth->execute(
            [
                ":list_item_id" => $list_item_id,
            ]
        );

        $result = $sth->fetch(\PDO::FETCH_ASSOC);

        $list_item->setId($result["id"]);
        $list_item->setName($result["name"]);

    }


    /**
     * Saves the model to storage
     *
     * @param StandardModel $model
     * @return null
     */
    public function create(CheckListItem $model)
    {
        $sth = $this->dsn->prepare("INSERT INTO list_items (list_id, name) VALUES (:list_id, :name)");
        $sth->execute(
            [
                ":list_id" => $model->getListId(),
                ":name" => $model->getName(),
            ]
        );

    }
}