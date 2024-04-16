<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_Order extends Model
{
    use HasFactory;

    protected $table = 'purchase_order';
    protected $Prinarykey = 'id';

    public function cart()
    {
        return $this->belongsToMany(Cart::class, 'cart_id', 'id' );
    }
    
}
