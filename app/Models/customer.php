<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class customer extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone', 'country', 'city', 'address', 'customer_type_id'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            $baseSlug = Str::slug($customer->name);
            $slug     = $baseSlug;
            $counter  = 1;

            // Tant que le slug existe déjà, ajoute -1, -2, etc.
            while (self::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $customer->slug = $slug;
        });

        // Optionnal: update the slug when to resources have the same name
        static::updating(function ($customer) {
            if ($customer->isDirty('name')) {
                $baseSlug = Str::slug($customer->name);
                $slug     = $baseSlug;
                $counter  = 1;

                while (self::where('slug', $slug)->where('id', '!=', $customer->id)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                $customer->slug = $slug;
            }
        });
    }
    public function customerType(): BelongsTo
    {
        return $this->belongsTo(customerType::class);
    }
    public function income(): HasMany
    {
        return $this->hasMany(income::class);
    }
}
