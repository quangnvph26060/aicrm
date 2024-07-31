<?php

namespace App\Services;

use App\Models\ProductStorage;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductStorageService
{
    protected $productStorage;
    public function __construct(ProductStorage $productStorage)
    {
        $this->productStorage = $productStorage;
    }

    public function updateProductStorage($productId, $storageId, array $data)
    {
        DB::beginTransaction();
        try {
            $productStorage = $this->productStorage->firstOrNew([
                'product_id' => $productId,
                'storage_id' => $storageId,
            ]);
            $productStorage->quantity = $data['quantity'];
            $productStorage->save();
            DB::commit();
            return $productStorage;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed to update product in storage: " . $e->getMessage());
            throw new Exception('Failed to update product in storage');
        }
    }
}
