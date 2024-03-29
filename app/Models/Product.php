<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title','description','color_id','category_id','manufacturer_id','price'];

    protected $appends = ['avarageStar'];

    public function getAvarageStarAttribute() {
        return $this->hasMany(Review::class, 'product_id', 'id')->avg('stars');
    }

    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function manufacturer() {
        return $this->hasOne(Manufacturer::class, 'id', 'manufacturer_id');
    }

    public function color() {
        return $this->hasOne(Color::class, 'id', 'color_id');
    }

    public function images() {
        return $this->hasMany(Image::class, 'product_id', 'id');
    }

    public function reviews() {
        return $this->hasMany(Review::class, 'product_id', 'id')->with('user');
    }

    public function product_materials() {
        return $this->hasMany(ProductMaterial::class, 'product_id', 'id');
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'product_materials', 'product_id', 'material_id');
    }

    public function warehouseProducts()
    {
        return $this->belongsToMany(Warehouse::class, 'warehouse_products', 'product_id', 'warehouse_id')
            ->withPivot('quantity');
    }

}
