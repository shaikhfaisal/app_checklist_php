<?php

namespace FS\Models\Adaptors;


use FS\Models\CheckList as CheckListModel;

interface DB_Adaptor
{
    public function saveToDB(CheckListModel $model);
}