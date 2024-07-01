<?php

namespace App\Models;

use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        "total_money",
        "status",
        "note",
        "receive_address",
        "user_id",
        'client_id',
        'name',
        'phone',
        'zip_code',
    ];
    protected $appends = ['order_detail','user_id','client_id'];
    public function getOrderDetailAttribute(){
        return OrderDetail::where('order_id', $this->attributes['id'])->with('product')->get();
    }
    public function getUserIdAttribute(){
        return User::where('id', $this->attributes['user_id'])->first();
    }
    public function getClientIdAttribute(){
        return Client::where('id', $this->attributes['client_id'])->first();
    }
    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class)->with('product');
    }

}
