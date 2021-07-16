<?php

namespace App\Http\Api\Controllers;

use App\Managers\CheckTypeManager;
use Illuminate\Http\Request;

class DataController
{
    private CheckTypeManager $checkType;

    public function __construct()
    {
        $this->checkType = resolve(CheckTypeManager::class);
    }

    public function index(string $type, Request $request)
    {
        return $this->checkType->driver($type)->response($request);
    }
}
