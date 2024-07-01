<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\ProductImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        "name",
        "price",
        "priceBuy",
        "product_unit",
        "quantity",
        "description",
        "is_featured",
        "is_new_arrival",
        "category_id",
        "status",
        'discount_id',
        'brands_id',
    ];

    protected $appends = ['category','images','brands'];
    public function getImagesAttribute(){
        return ProductImages::where('product_id',$this->attributes['id'])->get();
    }
    public function getCategoryAttribute(){
        return Categories::where('id',$this->attributes['category_id'])->first();
    }
    public function getBrandsAttribute(){
         return Brand::where('id',$this->attributes['brands_id'])->first();
    }
    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }
    public function categories()
    {
        return $this->belongsTo(Product::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImages::class);
    }

}
