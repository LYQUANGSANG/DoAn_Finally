<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'purchase_order';
    protected $prymarikey = 'id';

    protected $fillable = ['product_id', 'quantity'];

    public function purchase_order()
    {
        return $this->belongsToMany(purchase_order::class, 'cart_id', 'id');
    }
}
