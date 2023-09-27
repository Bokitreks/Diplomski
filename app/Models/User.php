<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class User extends Model
{
    protected $fillable = ['username','password','email','role_id'];
    use HasFactory;

    public function review() {
        return $this->hasMany(User::class, 'user_id', 'id');
    }
    public function shippingInfo()
    {
        return $this->hasOne(ShippingInfo::class, 'user_id');
    }
}
