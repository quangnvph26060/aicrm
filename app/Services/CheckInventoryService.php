<?php

namespace App\Services;

use App\Models\CheckInventory;



/**
 * Summary of CheckInventory
 */
class CheckInventoryService
{

    protected $checkInventory;

    public function __construct(CheckInventory $checkInventory)
    {
        $this->checkInventory = $checkInventory;
    }



}
