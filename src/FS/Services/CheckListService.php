<?php

namespace FS\Services;

use FS\Models\CheckList;
use FS\Models\Adaptors\CheckListAdaptor as CheckListAdaptor;
use FS\Models\CheckListItem;
use FS\Models\Adaptors\CheckListItemAdaptor;

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
        $list = new CheckList(new CheckListAdaptor());
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
        $list_item = new CheckListItem(new CheckListItemAdaptor());
        $list_item->setName($item_name)
            ->setListId($list_id)
            ->save();
    }
}