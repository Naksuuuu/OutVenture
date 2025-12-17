<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  use HasFactory;

  protected $table = 'Order';
  protected $primaryKey = 'id';

  protected $fillable = [
    'id_user',
    'tgl_order',
    'total_harga',
    'status_pembayaran',
  ];

  protected function casts(): array
  {
    return [
      'total_harga' => 'decimal:2',
      'tgl_order' => 'datetime',
    ];
  }


  public function user()
  {
    return $this->belongsTo(User::class, 'id_user', 'id');
  }

  public function items()
  {
    return $this->hasMany(OrderItem::class, 'id_order', 'id');
  }
}
