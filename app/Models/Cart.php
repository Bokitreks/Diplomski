<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'quantity', 'total', 'is_payed', 'shipping', 'is_finished'];

        public function user()
        {
            return $this->belongsTo(User::class)->with('shippingInfo');;
        }

        public function product()
        {
            return $this->belongsTo(Product::class);
        }
}
