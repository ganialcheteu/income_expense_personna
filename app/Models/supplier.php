<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
class supplier extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','phone','country','city','address'];
       protected static function boot()
    {
        parent::boot();

        static::creating(function ($supplier) {
            $baseSlug = Str::slug($supplier->name);
            $slug     = $baseSlug;
            $counter  = 1;

            // Tant que le slug existe déjà, ajoute -1, -2, etc.
            while (self::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $supplier->slug = $slug;
        });

        // Optionnal: update the slug when to resources have the same name
        static::updating(function ($supplier) {
            if ($supplier->isDirty('name')) {
                $baseSlug = Str::slug($supplier->name);
                $slug     = $baseSlug;
                $counter  = 1;

                while (self::where('slug', $slug)->where('id', '!=', $supplier->id)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                $supplier->slug = $slug;
            }
        });
    }
    public function expense(): HasMany
    {
        return $this->hasMany( expense::class);
    }
}
