<?php

namespace FS\Models;

use FS\Models\Adaptors\StorageAdaptor;

/**
 * Interface StandardModel
 * @package FS\Models
 */
interface StandardModel
{
    /**
     * StandardModel constructor.
     *
     * @param StorageAdaptor $db_adaptor
     */
    public function __construct(StorageAdaptor $db_adaptor);

    /**
     * @return mixed
     */
    public function save();
}