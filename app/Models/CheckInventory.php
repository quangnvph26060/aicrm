<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckInventory extends Model
{
    use HasFactory;
    protected $table = 'check_inventory';
    protected $fillable = ['user_id', 'note'];

    protected $appends = ['checkdetail'];
    public function details()
    {
        return $this->hasMany(CheckDetail::class, 'check_inventory_id');
    }

    public function getCheckdetailAttribute(){
        return CheckDetail::where('check_inventory_id',$this->attributes['id'])->get();
    }
}
