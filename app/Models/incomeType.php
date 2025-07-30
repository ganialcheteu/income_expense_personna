<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class incomeType extends Model
{
    use HasFactory;
    protected $fillable = ['type'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($incomeType) {
            $baseSlug = Str::slug($incomeType->type);
            $slug     = $baseSlug;
            $counter  = 1;

            // Tant que le slug existe déjà, ajoute -1, -2, etc.
            while (self::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $incomeType->slug = $slug;
        });

        // Optionnal: update the slug when to resources have the same type
        static::updating(function ($incomeType) {
            if ($incomeType->isDirty('type')) {
                $baseSlug = Str::slug($incomeType->type);
                $slug     = $baseSlug;
                $counter  = 1;

                while (self::where('slug', $slug)->where('id', '!=', $incomeType->id)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                $incomeType->slug = $slug;
            }
        });
    }
    public function income(): hasMany
    {
        return $this->hasMany(income::class);
    }
}
