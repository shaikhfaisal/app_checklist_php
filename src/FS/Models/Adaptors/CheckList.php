<?php

namespace FS\Models\Adaptors;

use FS\Models\CheckList as CheckListModel;

class CheckList implements DB_Adaptor
{

    private $dsn;

    public function __construct()
    {
        $this->dsn = new \PDO("pgsql:dbname=checklists;host=127.0.0.1", "checklists", "checklists");
    }

    public function saveToDB(CheckListModel $checklist_model)
    {

        $sth = $this->dsn->prepare("INSERT INTO lists (name) VALUES (:name)");
        $sth->execute(
            [
                ":name" => $checklist_model->getName(),
            ]
        );

    }
}