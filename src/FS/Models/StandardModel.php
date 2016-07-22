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
     * @return mixed
     */
    public function save();
}