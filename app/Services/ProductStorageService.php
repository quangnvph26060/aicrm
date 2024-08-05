<?php

namespace App\Services;

use App\Models\ImportCoupon;
use App\Models\ImportDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductStorage;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductStorageService
{
    protected $productStorage;
    protected $importCoupon;
    protected $importDetail;
    protected $order;
    protected $orderDetail;
    public function __construct(ProductStorage $productStorage, ImportCoupon $importCoupon, ImportDetail $importDetail, Order $order, OrderDetail $orderDetail)
    {
        $this->productStorage = $productStorage;
        $this->importCoupon = $importCoupon;
        $this->importDetail = $importDetail;
        $this->order = $order;
        $this->orderDetail = $orderDetail;
    }

    public function updateProductStorage($productId, $storageId, array $data)
    {
        DB::beginTransaction();
        try {
            $productStorage = $this->productStorage->firstOrNew([
                'product_id' => $productId,
                'storage_id' => $storageId,
            ]);
            $productStorage->quantity += $data['quantity'];
            $productStorage->save();
            DB::commit();
            return $productStorage;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed to update product in storage: " . $e->getMessage());
            throw new Exception('Failed to update product in storage');
        }
    }

    public function updateProductAmount($productId, $storageId, $amount)
    {
        DB::beginTransaction();
        try {
            // Tìm kiếm productStorage dựa trên product_id và storage_id
            $productStorage = $this->productStorage->where([
                ['product_id', '=', $productId],
                ['storage_id', '=', $storageId],
            ])->first();

            // Kiểm tra nếu không tìm thấy kết quả
            if (!$productStorage) {
                throw new Exception('Product storage not found.');
            }

            // Giảm số lượng và lưu lại
            $productStorage->quantity -= $amount;
            $productStorage->save();

            DB::commit();
            return $productStorage;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to update products amount: ' . $e->getMessage());
            throw new Exception('Failed to update products amount');
        }
    }

    public function inventoryReport($storage_id)
    {
        try {
            // Lấy thông tin nhập hàng gần nhất
            $latestImport = $this->importCoupon->where('storage_id', $storage_id)
                ->orderBy('created_at', 'desc')
                ->first();

            if (!$latestImport) {
                return []; // Trả về một mảng rỗng nếu không có hàng nhập
            }

            $products = $this->importDetail->where('import_id', $latestImport->id)
                ->with('product') // Tải mối quan hệ product
                ->get();

            // Khởi tạo mảng báo cáo
            $report = [];

            foreach ($products as $detail) {
                $currentProductId = $detail->product_id;

                // Lấy số lượng hiện tại
                $currentQuantity = $this->productStorage->where('storage_id', $storage_id)
                    ->where('product_id', $currentProductId)
                    ->value('quantity');

                $importedQuantity = $detail->quantity;

                // Tính số lượng đã bán kể từ ngày nhập hàng gần nhất
                $soldQuantity = $this->orderDetail->whereHas('order', function ($query) use ($latestImport) {
                    $query->where('created_at', '>', $latestImport->created_at);
                })->where('product_id', $currentProductId)
                    ->sum('quantity');

                // Tính số lượng trước khi nhập hàng
                $quantityBeforeImport = $currentQuantity + $soldQuantity - $importedQuantity;

                // Tính giá trị trước khi nhập hàng
                $beforeImportValue = $quantityBeforeImport * $detail->product->price;

                // Tính giá trị đã nhập
                $importedValue = $importedQuantity * $detail->price;

                // Tính giá trị đã bán
                $soldValue = $soldQuantity * $detail->product->priceBuy;

                // Tính giá trị hiện tại
                $currentValue = $currentQuantity * $detail->product->price;

                $report[] = [
                    'product_id' => $currentProductId,
                    'current_quantity' => $currentQuantity,
                    'imported_quantity' => $importedQuantity,
                    'quantity_before_import' => $quantityBeforeImport,
                    'before_import_value' => $beforeImportValue,
                    'imported_value' => $importedValue,
                    'sold_quantity' => $soldQuantity,
                    'sold_value' => $soldValue,
                    'current_value' => $currentValue,
                    'product' => $detail->product, // Thêm product vào report
                ];
            }

            return $report;
        } catch (Exception $e) {
            Log::error('Failed to get inventory report: ' . $e->getMessage());
            throw new Exception("Failed to get inventory report");
        }
    }
}
