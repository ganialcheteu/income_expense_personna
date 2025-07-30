<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

class activity extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];
        protected static function boot()
    {
        parent::boot();

        static::creating(function ($activity) {
            $baseSlug = Str::slug($activity->name);
            $slug     = $baseSlug;
            $counter  = 1;

            // Tant que le slug existe déjà, ajoute -1, -2, etc.
            while (self::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $activity->slug = $slug;
        });

        // Optionnal: update the slug when to resources have the same name
        static::updating(function ($activity) {
            if ($activity->isDirty('name')) {
                $baseSlug = Str::slug($activity->name);
                $slug     = $baseSlug;
                $counter  = 1;

                while (self::where('slug', $slug)->where('id', '!=', $activity->id)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                $activity->slug = $slug;
            }
        });
    }
    public function income(): hasMany
    {
        return $this->hasMany(income::class);
    }
    public function expense(): hasMany
    {
        return $this->hasMany(expense::class);
    }

    /**
     * Relation polymorphe avec le modèle Image
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'type', 'type', 'type_id');
    }

}
