<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

class Income extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'amount', 'payment_date', 'activity_id', 'customer_id', 'income_type_id', 'income_category_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($income) {
            $baseSlug = Str::slug($income->name);
            $slug     = $baseSlug;
            $counter  = 1;

            // Tant que le slug existe déjà, ajoute -1, -2, etc.
            while (self::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $income->slug = $slug;
        });

        // Optionnal: update the slug when two resources have the same name
        static::updating(function ($income) {
            if ($income->isDirty('name')) {
                $baseSlug = Str::slug($income->name);
                $slug     = $baseSlug;
                $counter  = 1;

                while (self::where('slug', $slug)->where('id', '!=', $income->id)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                $income->slug = $slug;
            }
        });
    }
    public function activity(): BelongsTo
    {
        return $this->belongsTo(activity::class);
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo(customer::class);
    }
    public function incomeType(): BelongsTo
    {
        return $this->belongsTo(incomeType::class);
    }
    public function incomeCategory(): BelongsTo
    {
        return $this->belongsTo(incomeCategory::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'type', 'type', 'type_id');
    }
}
