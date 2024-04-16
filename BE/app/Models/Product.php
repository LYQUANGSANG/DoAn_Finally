<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table ='products';
    protected $primarykey ='id';

    protected $fillable = [
        'name',
        'memo',
        'category_id',
        'sub_category_id',
        'status',
        'price',
        'isnew',
        'views',
        'quantity_sold',
        'image'
    ];

    public function SubCategory(){
        return $this->belongsTo(SubCategory::class, 'category_id', 'id');
    }

    public function Product_Detail(){
        return $this->hasOne(Product_Detail::class, 'product_id', 'id');
    }

    public function colorProducts()
    {
        return $this->hasMany(Color_Product::class, 'product_id', 'id');
    }


}
