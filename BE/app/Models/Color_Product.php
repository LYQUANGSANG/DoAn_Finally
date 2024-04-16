<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color_Product extends Model
{
    use HasFactory;

    protected $table ='Color_Product';
    protected $primarykey = 'id';

    public function Product_Detail(){
        return $this->belongsTo(Color_Product::class, 'product_id', 'id');
    }
    
    public function Product(){
        return $this->belongsTo(Product::class,'product_id', 'id');
    }
}
