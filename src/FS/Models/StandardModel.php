<?php

namespace FS\Models;

use FS\Models\Adaptors\DB_Adaptor;

/**
 * Interface StandardModel
 * @package FS\Models
 */
interface StandardModel
{
    /**
     * StandardModel constructor.
     *
     * @param DB_Adaptor $db_adaptor
     */
    public function __construct(DB_Adaptor $db_adaptor);

    /**
     * @return mixed
     */
    public function save();
}