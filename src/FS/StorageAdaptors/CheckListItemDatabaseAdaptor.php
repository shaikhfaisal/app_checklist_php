<?php

namespace FS\StorageAdaptors;

use FS\Models\StandardModel;

/**
 * Class CheckListItemAdaptor
 * @package FS\StorageAdaptors
 */
class CheckListItemDatabaseAdaptor implements StorageAdaptor
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
     * Saves the model to storage
     *
     * @param StandardModel $model
     * @return null
     */
    public function saveToStorage(StandardModel $model)
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