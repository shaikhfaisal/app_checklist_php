<?php

namespace FS\Models\Adaptors;

use FS\Models\StandardModel;

/**
 * Class CheckListAdaptor
 * @package FS\Models\Adaptors
 */
class CheckListAdaptor implements DB_Adaptor
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
    public function saveToStorage(StandardModel $checklist_model)
    {

        $sth = $this->dsn->prepare("INSERT INTO lists (name) VALUES (:name)");
        $sth->execute(
            [
                ":name" => $checklist_model->getName(),
            ]
        );

    }
}