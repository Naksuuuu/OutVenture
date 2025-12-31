<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Color extends Model
{
    use HasFactory;
    protected $table = 'colors';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_warna',
        'hex_code',
        'slug',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($color) {
            if (empty($color->slug)) {
                $color->slug = $color->generateSlug();
            }
        });

        static::updating(function ($color) {
            if ($color->isDirty('nama_warna') && empty($color->slug)) {
                $color->slug = $color->generateSlug();
            }
        });
    }

    protected function generateSlug(): string
    {
        $baseSlug = Str::slug($this->nama_warna);
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






    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class, 'id_color', 'id');
    }
}
