<?php
namespace FS\Models;


use FS\StorageAdaptors\StorageAdaptor;

/**
 * Class CheckListItem
 * @package FS\Models
 */
class CheckListItem implements StandardModel
{
    /**
     * @var object DB_Adaptor
     */
    private $db_adaptor;

    /**
     * @var integer
     */
    private $list_id;

    /**
     * @var string
     */
    private $name;

    /**
     * CheckListItem constructor.
     * @param StorageAdaptor $db_adaptor
     */
    public function __construct($id = null, StorageAdaptor $db_adaptor)
    {
        $this->db_adaptor = $db_adaptor;

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getListId()
    {
        return $this->list_id;
    }

    /**
     * @param mixed $list_id
     */
    public function setListId($list_id)
    {
        $this->list_id = $list_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Save the model to the storage medium
     */
    public function save()
    {
        $this->db_adaptor->saveToStorage($this);
    }
}