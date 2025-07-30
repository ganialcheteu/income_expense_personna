<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\support\Str;

class ExpenseType extends Model
{
    use HasFactory;
    protected $fillable = ['type'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($expenseType) {
            $baseSlug = Str::slug($expenseType->type);
            $slug     = $baseSlug;
            $counter  = 1;

            // Tant que le slug existe déjà, ajoute -1, -2, etc.
            while (self::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $expenseType->slug = $slug;
        });

        // Optionnal: update the slug when to resources have the same
        static::updating(function ($expenseType) {
            if ($expenseType->isDirty('type')) {
                $baseSlug = Str::slug($expenseType->type);
                $slug     = $baseSlug;
                $counter  = 1;

                while (self::where('slug', $slug)->where('id', '!=', $expenseType->id)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                $expenseType->slug = $slug;
            }
        });
    }
    public function expense(): HasMany
    {
        return $this->hasMany(Expense::class);
    }
}
