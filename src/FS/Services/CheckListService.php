<?php

namespace FS\Services;

use FS\Models\CheckList;
use FS\StorageAdaptors\CheckListDatabaseAdaptor;
use FS\Models\CheckListItem;
use FS\StorageAdaptors\CheckListItemDatabaseAdaptor;

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
        $list_item->setName($item_name);

        $list->addCheckListItem($list_item, true);

    }

    /**
     * @param $list_id
     * @param $item_name
     */
    public function removeItemFromList($list_id, $item_name)
    {
        $list = new CheckList($list_id, new CheckListDatabaseAdaptor());
        $list->removeListItem($item_name);
    }
}