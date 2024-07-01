<?php

namespace App\Services;

use App\Models\Categories;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryService
{
    protected $categories;
    public function __construct(Categories $categories)
    {
        $this->categories = $categories;
    }

    public function getCategoryAll(){
        try {
            Log::info('Fetching all products');
            return $this->categories->all();
        } catch (Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage());
            throw new Exception('Failed to fetch products');
        }
    }

    public function updateCategory(int $id, array $data): Categories
    {
        DB::beginTransaction();
        try {
            Log::info("Updating category with ID: $id");
            $category = $this->categories->findOrFail($id);
            $category->update($data);
            DB::commit();
            return $category;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to update category: ' . $e->getMessage());
            throw new Exception('Failed to update category');
        }
    }

    public function deleteCategory(int $id): void
    {
        DB::beginTransaction();
        try {
            Log::info("Deleting category with ID: $id");
            $category = $this->categories->findOrFail($id);
            $category->delete();
            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            Log::error('Category not found: ' . $e->getMessage());
            throw new ModelNotFoundException('Category not found');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to delete category: ' . $e->getMessage());
            throw new Exception('Failed to delete category');
        }
    }
    public function findOrFailCategory($id)
    {
        try {
            Log::info('Creating new category');
            $category = $this->categories->findOrFail($id);

            return $category;
        } catch (Exception $e) {

            Log::error('Failed to find category: ' . $e->getMessage());
            throw new Exception('Failed to find category');
        }
    }
    public function findCategory($name)  {
        try{
            $category = $this->categories->where('name', 'LIKE', '%' . $name . '%')->get();
            if ($category->isEmpty()) {
                throw new Exception('Category not found');
            }
            Log::info($category );
            return $category;
        }catch(Exception $e){
            Log::error('Failed to find category: ' . $e->getMessage());
            throw new Exception('Failed to find category');
        }
    }

}
