<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ClientGroup;
use App\Models\Config;
use App\Models\Product;
use App\Services\ClientGroupService;
use App\Services\ClientService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    protected $productService;
    protected $clientService;
    protected $clientGroupService;
    public function __construct(ProductService $productService, ClientService $clientService, ClientGroupService $clientGroupService)
    {
        $this->productService = $productService;
        $this->clientService = $clientService;
        $this->clientGroupService = $clientGroupService;
    }
    public function index()
    {
        $storage_id = session('authUser')->storage_id;
        $product = $this->productService->getPRoductInStorage_Staff($storage_id);
        $title = "Quản lý bán hàng";
        $config = Config::first();
        // $product = $this->productService->getProductAll_Staff();
        $clients = $this->clientService->getAllClientStaff();
        $clientgroup = $this->clientGroupService->getAllClientGroup();
        $user = Auth::user();
        $cart =  Cart::where('user_id', $user->id)->get();
        foreach ($cart as $key => $item) {
            $item->delete();
        }
        $sum = 0;
        foreach ($cart as $key => $value) {
            $sum += $value->product->priceBuy * $value->amount;
        }
        return view('Themes.pages.layout_staff.index', compact('product', 'clients', 'cart', 'sum', 'config', 'title', 'clientgroup'));
    }

    public function product()
    {
        $storage_id = session('authUser')->storage_id;
        $products = $this->productService->getPRoductInStorage_Staff($storage_id);
        return response()->json($products);
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = $this->productService->getProductById($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        $user = Auth::user();
        $existingCartItem = Cart::where('product_id', $productId)
            ->where('user_id', $user->id)
            ->first();
        $amount = $request->input('amount');
        if ($existingCartItem) {
            // Giảm số lượng xuống 0 hoặc loại bỏ sản phẩm khỏi giỏ hàng nếu giảm xuống dưới 1
            $existingCartItem->update(['amount' => $existingCartItem->amount + 1]);
        } else {

            Cart::create([
                'product_id' => $productId,
                'price' => $product->priceBuy,
                'user_id' => $user->id,
                'amount' => $amount
            ]);
        }


        $cartItems = Cart::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $products = [];
        $sum = 0;
        foreach ($cartItems as $item) {
            $sum += $item->amount * $item->price;
            $product = Product::find($item->product_id);
            if ($product) {
                $products[] = [
                    'id' => $item->id,
                    'product_id' => $item->product_id,
                    'amount' => $item->amount,
                    'priceBuy' => $item->price,
                    'product_name' => $product->name,
                ];
            }
        }
        return response()->json(['success' => 'Product added to cart!', 'cart' => $products, 'sum' => number_format($sum)]);
    }


    public function updateCart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = $this->productService->getProductById($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        $user = Auth::user();
        $existingCartItem = Cart::where('product_id', $productId)
            ->where('user_id', $user->id)
            ->first();
        $amount = $request->input('amount');

        $existingCartItem->update(['amount' => $amount]);

        $cartItems = Cart::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $products = [];
        $sum = 0;
        foreach ($cartItems as $item) {
            $sum += $item->amount * $item->price;
            $product = Product::find($item->product_id);
            if ($product) {
                $products[] = [
                    'id' => $item->id,
                    'product_id' => $item->product_id,
                    'amount' => $item->amount,
                    'priceBuy' => $item->price,
                    'product_name' => $product->name,
                ];
            }
        }
        return response()->json(['success' => 'Product added to cart!', 'cart' => $products, 'sum' => number_format($sum)]);
    }

    public function removeFromCart(Request $request)
    {
        $user = Auth::user();

        $cart = $request->input('cart');
        Cart::find($cart)->delete();
        $cartItems = Cart::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $products = [];
        $sum = 0;
        foreach ($cartItems as $item) {
            $sum += $item->amount * $item->price;
            $product = Product::find($item->product_id);
            if ($product) {
                $products[] = [
                    'id' => $item->id,
                    'product_id' => $item->product_id,
                    'amount' => $item->amount,
                    'priceBuy' => $item->price,
                    'product_name' => $product->name,
                ];
            }
        }
        return response()->json(['success' => 'Product added to cart!', 'cart' => $products, 'sum' => number_format($sum)]);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('name');

        $products = $this->productService->productByNameStaff($searchTerm);

        return response()->json($products);
    }

    public function updatePriceCart(Request $request)
    {

        $user = Auth::user();
        $existingCartItem = Cart::find($request->cart);
        $price = $request->price;

        $existingCartItem->update(['price' => $price]);

        $cartItems = Cart::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $products = [];
        $sum = 0;
        foreach ($cartItems as $item) {
            $sum += $item->amount * $item->price;
            $product = Product::find($item->product_id);
            if ($product) {
                $products[] = [
                    'id' => $item->id,
                    'product_id' => $item->product_id,
                    'amount' => $item->amount,
                    'priceBuy' => $item->price,
                    'product_name' => $product->name,
                ];
            }
        }
        return response()->json(['success' => 'Product added to cart!', 'cart' => $products, 'sum' => number_format($sum)]);
    }
}
