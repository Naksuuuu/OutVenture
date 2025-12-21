<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
  use HasFactory;

  protected $table = 'OrderItem';
  protected $primaryKey = 'id';

  protected $fillable = [
    'id_order',
    'id_variant_spec',
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
    return $this->belongsTo(Order::class, 'id_order', 'id');
  }

  public function variantSpec()
  {
    return $this->belongsTo(ProductVariantSpec::class, 'id_variant_spec', 'id');
  }
}
