<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Detail extends Model
{
    use HasFactory;
    protected $table ='Product_Detail';
    protected $primarykey = 'id';

    public function Product(){
        return $this->hasOne(Product::class, 'product_id', 'id');
    }
}
