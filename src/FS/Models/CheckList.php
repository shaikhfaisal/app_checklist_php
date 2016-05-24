<?php
namespace FS\Models;

use FS\Models\Adaptors\CheckList as DatabaseAdaptor;


class CheckList
{
    private $name;

    private $db_adaptor;

    /**
     * CheckList constructor.
     * @param $name
     */
    public function __construct(DatabaseAdaptor $db_adaptor)
    {
        $this->db_adaptor = $db_adaptor;
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
     * @return CheckList
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function save()
    {
        $this->db_adaptor->saveToDB($this);
    }


}