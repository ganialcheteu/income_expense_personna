<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class CustomerType extends Model
{
   use HasFactory;
   protected $fillable = ['type'];
       protected static function boot()
    {
        parent::boot();

        static::creating(function ($customerType) {
            $baseSlug = Str::slug($customerType->type);
            $slug     = $baseSlug;
            $counter  = 1;

            // Tant que le slug existe déjà, ajoute -1, -2, etc.
            while (self::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $customerType->slug = $slug;
        });

        // Optionnal: update the slug when to resources have the same type
        static::updating(function ($customerType) {
            if ($customerType->isDirty('name')) {
                $baseSlug = Str::slug($customerType->type);
                $slug     = $baseSlug;
                $counter  = 1;

                while (self::where('slug', $slug)->where('id', '!=', $customerType->id)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                $customerType->slug = $slug;
            }
        });
    }
   public function customer(): HasMany
   {
    return $this->hasMany(Customer::class);
   }
}
