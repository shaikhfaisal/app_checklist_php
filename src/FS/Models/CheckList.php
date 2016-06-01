<?php
namespace FS\Models;

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
     * @var object DatabaseAdaptor
     */
    private $db_adaptor;

    /**
     * CheckList constructor.
     *
     * @param StorageAdaptor $db_adaptor
     */
    public function __construct($list_id = null, StorageAdaptor $db_adaptor)
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
        $this->db_adaptor->saveToStorage($this);
    }

    public function addCheckListItem(CheckListItem $list_item)
    {
        $this->list_items[] = $list_item;

        $this->db_adaptor->addCheckListItem($this, $list_item);
    }


}