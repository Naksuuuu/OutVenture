<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user',
        'id_variant_spec',
    ];


    public function cartitems()
    {
        return $this->hasMany(CartItem::class, 'id_cart', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
