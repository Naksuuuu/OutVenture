<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_brand', 'image', 'wide_image', 'logo', 'is_trusted', 'slug'];
    protected $casts = [
        'is_trusted' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($brand) {
            if (empty($brand->slug)) {
                $brand->slug = $brand->generateSlug();
            }
        });

        static::updating(function ($brand) {
            if ($brand->isDirty('nama_brand') && empty($brand->slug)) {
                $brand->slug = $brand->generateSlug();
            }
        });
    }

    protected function generateSlug(): string
    {
        $baseSlug = Str::slug($this->nama_brand);
        $slug = $baseSlug;
        $counter = 1;

        while (static::where('slug', $slug)->where('id', '!=', $this->id ?? 0)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

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
