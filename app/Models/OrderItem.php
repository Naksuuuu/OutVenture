<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
  use HasFactory;

  protected $table = 'order_items';
  protected $primaryKey = 'id_order_item';

  protected $fillable = [
    'id_order',
    'id_variant',
    'tgl_order',
    'quantity',
    'harga',
  ];

  protected function casts(): array
  {
    return [
      'harga' => 'decimal:2',
      'tgl_order' => 'datetime',
    ];
  }


  public function order()
  {
    return $this->belongsTo(Order::class, 'id_order', 'id_order');
  }

  public function variant()
  {
    return $this->belongsTo(ProductVariant::class, 'id_variant', 'id_variant');
  }
}
