<?php
namespace FS\Models;

use FS\Models\Adaptors\DB_Adaptor;

/**
 * Class CheckList
 * @package FS\Models
 */
class CheckList implements StandardModel
{
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
     * @param DB_Adaptor $db_adaptor
     */
    public function __construct(DB_Adaptor $db_adaptor)
    {
        $this->db_adaptor = $db_adaptor;
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


}