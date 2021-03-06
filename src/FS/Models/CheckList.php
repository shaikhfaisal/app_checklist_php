<?php
namespace FS\Models;

use FS\StorageAdaptors\CheckListDatabaseAdaptor;
use FS\StorageAdaptors\StorageAdaptor;

/**
 * Class CheckList
 * @package FS\Models
 */
class CheckList implements StandardModel
{
    /**
     * @type integer id
     */
    private $id;
    /**
     * @var string Name of the checklist
     */
    private $name;
    /**
     * @var object
     */
    private $db_adaptor;

    /**
     * @type array
     */
    private $list_items;

    /**
     * CheckList constructor.
     *
     * @param StorageAdaptor $db_adaptor
     */
    public function __construct($list_id = null, CheckListDatabaseAdaptor $db_adaptor)
    {
        $this->db_adaptor = $db_adaptor;

        if (!is_null($list_id) && !empty($list_id)) {
            $this->db_adaptor->hydrate($list_id, $this);
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return object CheckList
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Requests the db_adaptor to save the model.
     */
    public function save()
    {
        $this->db_adaptor->create($this);
    }

    /**
     * @param CheckListItem $list_item
     */
    public function addCheckListItem(CheckListItem $list_item, $persist_to_db = false)
    {
        $this->list_items[$list_item->getId()] = $list_item;

        if ($persist_to_db) {
            $this->db_adaptor->addCheckListItem($this, $list_item);
        }

    }

    /**
     * @return array CheckListItem
     */
    public function getListItems()
    {
        return $this->list_items;
    }


    /**
     * @param $item_name
     */
    public function removeListItem($item_name)
    {

        $list_items = $this->getListItems();
        if (sizeof($list_items) > 0) {
            /** @object  $list_item CheckListItem*/
            foreach ($this->getListItems() as $list_item) {
                if ($item_name == $list_item->getName()) {
                    unset($this->list_items[$list_item->getId()]);
                    $this->db_adaptor->removeCheckListItem($this, $list_item);
                    break;
                }
            }
        }

    }

}