<?php

namespace App\Services;

use App\Models\CheckInventory;
use Exception;
use Illuminate\Support\Facades\Log;



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

    public function getAllCheckInventory() : \Illuminate\Database\Eloquent\Collection
    {

        try {
            $checkInventory = $this->checkInventory->all();
            return $checkInventory;
        } catch (Exception $e) {
            Log::error('Failed to get all checkInventory: ' . $e->getMessage());
            throw new Exception('Failed to get all checkInventory');
        }
    }

    /**
     * Summary of getCheckInventoryById
     * @param mixed $id
     * @throws Exception
     * @return CheckInventory
     */
    public function getCheckInventoryById($id): CheckInventory
    {

        try {
            $checkInventory = $this->checkInventory->find($id);
            return $checkInventory;
        } catch (Exception $e) {
            Log::error('Failed to get  checkInventory by '. $id. '-'. $e->getMessage());
            throw new Exception('Failed to get  checkInventory by ' .$id);
        }
    }



}
