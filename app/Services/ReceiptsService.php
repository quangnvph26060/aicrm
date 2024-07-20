<?php

namespace App\Services;

use App\Models\Receipts;
use Exception;
use Illuminate\Support\Facades\Log;

class ReceiptsService
{
    protected $receipts;
    public function __construct(Receipts $receipts){
        $this->receipts = $receipts;
    }

    public function getAllReceipts(){
        try {
            Log::info('Fetching all receipts');
            return $this->receipts->orderByDesc('created_at')->get();
        } catch (Exception $e) {
            Log::error('Failed to fetch receipts: ' . $e->getMessage());
            throw new Exception('Failed to fetch receipts');
        }
    }

    public function addReceipts($data){
        try {
            Log::info('Fetching add receipts');
            $receipts = $this->receipts->create($data);
            return $receipts;
        } catch (Exception $e) {
            Log::error('Failed to  add receipts: ' . $e->getMessage());
            throw new Exception('Failed to add receipts');
        }
    }

}
