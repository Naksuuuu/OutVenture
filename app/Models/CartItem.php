<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $table = 'cart_items';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_cart',
        'id_variant_spec',
        'quantity',
    ];


    public function variantSpec()
    {
        return $this->belongsTo(ProductVariantSpec::class, 'id_variant_spec', 'id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'id_cart', 'id');
    }
}
