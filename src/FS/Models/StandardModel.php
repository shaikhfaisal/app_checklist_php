<?php

namespace FS\Models;

use FS\StorageAdaptors\StorageAdaptor;

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
    public function __construct($id = null, StorageAdaptor $db_adaptor);

    /**
     * @return mixed
     */
    public function save();
}