<?php
namespace FS\Models\Adaptors;

use FS\Models\StandardModel;

/**
 * Interface DB_Adaptor
 * @package FS\Models\Adaptors
 */
interface StorageAdaptor
{
    /**
     * @param StandardModel $model
     * @return mixed
     */
    public function saveToStorage(StandardModel $model);
}