<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
  use HasFactory;

  protected $table = 'Category';
  protected $primaryKey = 'id';

  protected $fillable = [
    'nama_category',
  ];

  public function products()
  {
    return $this->hasMany(Product::class, 'id_category', 'id');
  }

  public function sizes()
  {
    return $this->hasMany(Size::class, 'id_category', 'id');
  }
}
