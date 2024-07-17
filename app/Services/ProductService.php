<?php

namespace App\Services;
use App\Models\Product;
use App\Models\ProductImages;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class ProductService
{
    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProductAll(): LengthAwarePaginator
    {
        try {
            Log::info('Fetching all products');
            // $product= $this->product->paginate(10);
            // dd($product[0]->images[0]->image_path);
            return $this->product->orderByDesc('created_at')->paginate(5);
        } catch (Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage());
            throw new Exception('Failed to fetch products');
        }
    }

    public function getProductAll_Staff() : \Illuminate\Database\Eloquent\Collection
    {
        try {
            Log::info('Fetching all products');
             $product= $this->product->all();
            // dd($product[0]->images[0]->image_path);
            return $product;

        } catch (Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage());
            throw new Exception('Failed to fetch products');
        }
    }

    public function getProductById($id): Product
    {
        try {
            Log::info('Fetching  products by id');
            return $this->product->find($id);
        } catch (Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage());
            throw new Exception('Failed to Fetching  products by id');
        }
    }

    public function getProductsByStatus(): \Illuminate\Database\Eloquent\Collection
    {
        try {
            Log::info('Fetching all products by published');
            return $this->product->where('status', 'published')->where('quantity','>', 0)->get();
        } catch (Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage());
            throw new Exception('Failed to fetch products');
        }
    }

    public function createProduct(array $data): Product
    {
        DB::beginTransaction();

        try {
            Log::info("Creating a new product with name: {$data['name']}");

            $product = $this->product->create([
                'name' => $data['name'],
                'price' => $data['price'],
                'priceBuy' => $data['priceBuy'],
                'quantity' => $data['quantity'],
                'product_unit' => @$data['product_unit'],
                'category_id' => $data['category_id'],
                'description' => $data['description'],
                'is_featured' => @$data['is_featured'],
                'is_new_arrival' => @$data['is_new_arrival'],
                'status' =>  $data['status'],
                'discount_id' => @$data['discount_id'],
                'brands_id' => @$data['brand_id'],
            ]);


            if ($product) {
                foreach ($data['images'] as $item) {
                    $image = $item;
                    $filename = 'image_'. $image->getClientOriginalName();
                    $filePath = 'storage/product/' . $filename;
                    if (!Storage::exists($filePath)) {
                        $image->storeAs('public/product', $filename);
                    }
                    Storage::putFileAs('public/product', $image, $filename);
                    $image = new ProductImages();
                    $image->product_id = $product->id;
                    $image->image_path = $filePath;
                    $image->save();
                }
            }
            DB::commit();
            return $product;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed to create product: {$e->getMessage()}");
            throw new Exception('Failed to create product');
        }
    }

    public function updateProduct(int $id, array $data): Product
    {
        $existingImagePaths = ProductImages::where('product_id', $id)->pluck('image_path')->toArray();
        $imageNames = [];
        foreach ($existingImagePaths as $path) {
            $fullFileName = basename($path);
            $pattern = '/image_(.*)/';
            if (preg_match($pattern, $fullFileName, $matches)) {
                $imageNames[] = $matches[1];
            }
        }

        DB::beginTransaction();
        try {
            $product = $this->getProductById($id);
            Log::info("Updating product with ID: $id");
            $update = $product->update($data);
            if ($update) {
                if (isset($data['images'])) {
                    foreach ($data['images'] as $item) {
                        $image = $item;
                        $filename = 'image_'. $image->getClientOriginalName();
                        $filePath = 'storage/product/' . $filename;
                        if (!in_array($image->getClientOriginalName(), $imageNames)) {
                            Storage::putFileAs('public/product', $image, $filename);
                            $image = new ProductImages();
                            $image->product_id = $product->id;
                            $image->image_path = $filePath;
                            $image->save();
                        }
                    }
                }
            }
            DB::commit();
            return $product;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed to update product: {$e->getMessage()}");
            throw new Exception('Failed to update product');
        }
    }

    public function deleteProduct(int $id): void
    {
        DB::beginTransaction();
        try {
            $product = $this->getProductById($id);
            // dd($product);
            $productimages = ProductImages::where('product_id', $id)->get();
            foreach ($productimages as $image) {
                $image->delete();
            }
            $product->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Failed to delete product: {$e->getMessage()}");
            throw new Exception('Failed to delete product');
        }
    }

    public function getProductByCategory($categoryId): \Illuminate\Database\Eloquent\Collection
    {
        try {
            Log::info('Fetching  products by categoryId');
            return $this->product->where('category_id', $categoryId)->get();
        } catch (Exception $e) {
            Log::error('Failed to fetch products by categoryId: ' . $e->getMessage());
            throw new Exception('Failed to fetch products by categoryId');
        }
    }

    public function getProductByBrand($brand_id): \Illuminate\Database\Eloquent\Collection
    {
        try {
            Log::info('Fetching  products by brands');
            return $this->product->where('brands_id ', $brand_id)->get();
        } catch (Exception $e) {
            Log::error('Failed to fetch products: ' . $e->getMessage());
            throw new Exception('Failed to fetch products by brands');
        }
    }

    public function productByName($name):LengthAwarePaginator
    {
        try {
            $products = $this->product->where('name', 'LIKE', '%' . $name . '%')->paginate(5);
            // dd($products);
            return $products;
        } catch (Exception $e) {
            Log::error("Failed to search products: {$e->getMessage()}");
            throw new Exception('Failed to search products');
        }
    }

    public function productByNameStaff($name):\Illuminate\Database\Eloquent\Collection
    {
        try {
            $products = $this->product->where('name', 'LIKE', '%' . $name . '%')->get();
            // dd($products);
            return $products;
        } catch (Exception $e) {
            Log::error("Failed to search products: {$e->getMessage()}");
            throw new Exception('Failed to search products');
        }
    }


}
