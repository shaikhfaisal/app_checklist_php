<?php
namespace FS\StorageAdaptors;

use FS\Models\StandardModel;

/**
 * Interface DB_Adaptor
 * @package FS\StorageAdaptors
 */
interface StorageAdaptor
{
    /**
     * @param StandardModel $model
     * @return mixed
     */
    public function saveToStorage(StandardModel $model);
}