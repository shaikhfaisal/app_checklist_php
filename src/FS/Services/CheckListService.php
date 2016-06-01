<?php

namespace FS\Services;

use FS\Models\CheckList;
use FS\Models\Adaptors\CheckListDatabaseAdaptor;
use FS\Models\CheckListItem;
use FS\Models\Adaptors\CheckListItemDatabaseAdaptor;

/**
 * Class CheckListService
 * @package FS\Services
 */
class CheckListService
{

    /**
     * Create a list
     *
     * @param $list_name
     */
    public function createList($list_name)
    {
        $list = new CheckList(null, new CheckListDatabaseAdaptor());
        $list->setName($list_name)
            ->save();
    }

    /**
     * Add an item to a list
     *
     * @param $list_id
     * @param $item_name
     */
    public function addItemToList($list_id, $item_name)
    {
        $list = new CheckList($list_id, new CheckListDatabaseAdaptor());
        $list_item = new CheckListItem(null, new CheckListItemDatabaseAdaptor());

        $list->addCheckListItem($list_item);

    }
}