<?php

namespace App\Services;

use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SupplierService
{
    protected $supplier;
    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    public function GetAllSupplier()
    {
        try {
            return $this->supplier->orderByDesc('created_at')->paginate(5);
        } catch (Exception $e) {
            Log::error('Failed to fetch Supplier : ' . $e->getMessage());
            throw new Exception('Failed to fetch Supplier');
        }
    }

    public function findSupplierByPhone($phone)
    {
        try {
            $supplier = $this->supplier->where('phone', $phone)->first();
            return $supplier;
        } catch (Exception $e) {
            Log::error('Failed to find supplier information: ' . $e->getMessage());
            throw new Exception('Failed to find supplier informations');
        }
    }

    public function addSupplier(array $data)
    {
        DB::beginTransaction();
        try {
            $supplier = $this->supplier->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address']
            ]);
            DB::commit();
            return $supplier;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed Add Supplier : " . $e->getMessage());
            throw new Exception("Failed Add Supplier");
        }
    }

    public function findSupplierById($id)
    {
        try{
            return $this->supplier->find($id);
        }
        catch (Exception $e) {
            Log::error('Failed to find suppler: ' . $e->getMessage());
            throw new Exception('Failed to find supplier');
        }

    }

    public function updateSupplier(array $data, $id)
    {
        DB::beginTransaction();
        try {
            $supplier = $this->supplier->find($id);
            $supplier->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address']
            ]);
            DB::commit();
            return $supplier;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed update Supplier : " . $e->getMessage());
            throw new Exception("Failed update Supplier");
        }
    }

    public function deleteSupplier($id)
    {
        DB::beginTransaction();
        try {
            $supplier = $this->supplier->find($id);
            $supplier->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed update Supplier : " . $e->getMessage());
            throw new Exception("Failed update Supplier");
        }
    }
}
