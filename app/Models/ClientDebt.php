<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientDebt extends Model
{
    use HasFactory;
    protected $table = 'customer_debts';

    protected $fillable = [
        'client_id',
        'amount',
        'description',
    ];

    protected $appends = ['client', 'detail'];
    public function getClientAttribute(){
        return Client::where('id',$this->attributes['client_id'])->first();
    }

    public function getDetailAttribute(){
        return ClientDebtsDetail::where('customer_debts_id', $this->attributes['id'])->get();
    }


}
