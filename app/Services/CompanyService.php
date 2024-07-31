<?php

namespace App\Services;

use App\Models\Company;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompanyService
{
    protected $company;
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function getAllCompany():LengthAwarePaginator
    {
        try {
            return $this->company->orderByDesc('created_at')->paginate(5);
        } catch (Exception $e) {
            Log::error('Failed to fetch companies: ' . $e->getMessage());
            throw new Exception('Failed to fetch companies');
        }
    }

    public function getCompany()
    {
        try {
            return $this->company->get();
        } catch (Exception $e) {
            Log::error('Failed to fetch companies: ' . $e->getMessage());
            throw new Exception('Failed to fetch companies');
        }
    }

    public function getCompanyByName($name)
    {
        try {
            return $this->company->where('name', 'LIKE', '%' . $name . '%')->paginate(5);
        } catch (Exception $e) {
            Log::error('Failed to get company by name: ' . $e->getMessage());
            throw new Exception('Failed to get company by name');
        }
    }
    public function findCompanyById($id)
    {
        try {
            return $this->company->find($id);
        } catch (Exception $e) {
            Log::error('Failed to find company: ' . $e->getMessage());
            throw new Exception('Failed to find company');
        }
    }
    public function addCompany(array $data)
    {
        try {
            $company = $this->company->create([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'address' => $data['address'],
                'tax_number' => $data['tax_number'],
                'bank_account' => $data['bank_account'],
                'bank_id' => $data['bank_id'],
                'note' => $data['note'],
            ]);
            DB::commit();
            return $company;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to add company: ' . $e->getMessage());
            throw new Exception('Failed to add company');
        }
    }

    public function updateCompany(array $data, $id)
    {
        DB::beginTransaction();
        try {
            $company = $this->company->find($id);
            if (!$company) {
                throw new \Exception('Company not found');
            }

            $company->update([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'address' => $data['address'],
                'tax_number' => $data['tax_number'],
                'bank_account' => $data['bank_account'],
                'bank_id' => $data['bank_id'],
                'note' => $data['note'],
            ]);

            DB::commit();
            return $company;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to update company: ' . $e->getMessage());
            throw new Exception('Failed to update company');
        }
    }

    public function deleteCompany($id)
    {
        DB::beginTransaction();
        try {
            $company = $this->company->find($id);
            $company->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to delete company: ' . $e->getMessage());
            throw new Exception('Failed to delete company');
        }
    }
}