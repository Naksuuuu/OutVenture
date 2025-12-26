<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_brand', 'image', 'wide_image', 'logo', 'is_trusted'];
    protected $casts = [
        'is_trusted' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::deleting(function (Brand $brand) {
            foreach (['image', 'wide_image', 'logo'] as $field) {
                if (!empty($brand->{$field})) {
                    Storage::disk('public')->delete($brand->{$field});
                }
            }
        });
    }


    public function products()
    {
        return $this->hasMany(Product::class, 'id_brand', 'id');
    }
}
