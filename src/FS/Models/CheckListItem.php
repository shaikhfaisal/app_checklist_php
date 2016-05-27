<?php
namespace FS\Models;


use FS\Models\Adaptors\DB_Adaptor;

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
     * @param DB_Adaptor $db_adaptor
     */
    public function __construct(DB_Adaptor $db_adaptor)
    {
        $this->db_adaptor = $db_adaptor;
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