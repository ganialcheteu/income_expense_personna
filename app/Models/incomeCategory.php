<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class incomeCategory extends Model
{
    use HasFactory;
    protected $fillable = ['category'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($incomeCategory) {
            $baseSlug = Str::slug($incomeCategory->category);
            $slug     = $baseSlug;
            $counter  = 1;

            // Tant que le slug existe déjà, ajoute -1, -2, etc.
            while (self::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $incomeCategory->slug = $slug;
        });
        // Optionnal: update the slug when to resources have the same category
        static::updating(function ($incomeCategory) {
            if ($incomeCategory->isDirty('category')) {
                $baseSlug = Str::slug($incomeCategory->category);
                $slug     = $baseSlug;
                $counter  = 1;

                while (self::where('slug', $slug)->where('id', '!=', $incomeCategory->id)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                $incomeCategory->slug = $slug;
            }
        });
    }
    public function income(): hasMany
    {
        return $this->hasMany(income::class);
    }

}
