<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
  use HasFactory;

  protected $table = 'Attribute';
  protected $primaryKey = 'id';

  protected $fillable = [
    'nama_attribute',
  ];

  public function specs()
  {
    return $this->hasMany(ProductVariantSpec::class, 'id_attribute', 'id');
  }
}
