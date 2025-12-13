<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
  use HasFactory;

  protected $table = 'attributes';
  protected $primaryKey = 'id_attribute';

  protected $fillable = [
    'nama_attribute',
  ];

  public function specs()
  {
    return $this->hasMany(ProductVariantSpec::class, 'id_attribute', 'id_attribute');
  }
}
