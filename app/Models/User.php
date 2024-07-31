<?php

namespace App\Models;

use App\Models\UserInfo;
use App\Models\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'name', 'phone', 'email', 'company_name', 'password', 'status', 'role_id', 'city_id', 'tax_code', 'store_name', 'field_id', 'domain', 'address', 'storage_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = ['user_info'];

    public function getUserInfoAttribute()
    {
        return UserInfo::where('user_id', $this->attributes['id'])->first();
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function config()
    {
        return $this->hasOne(Config::class);
    }

    // New relationship with Storage
    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }
}
