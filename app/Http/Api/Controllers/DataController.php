<?php

use App\Managers\CheckTypeManager;

class DataController
{
    private CheckTypeManager $checkType;

    public function __construct()
    {
        $this->checkType = resolve(CheckTypeManager::class);
    }

    public function index(string $type)
    {
        return $this->checkType->driver($type)->response();
    }
}