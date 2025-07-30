<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ExpenseCategory extends Model
{
    use HasFactory;
    protected $fillable = ['category'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($expenseCategory) {
            $baseSlug = Str::slug($expenseCategory->category);
            $slug     = $baseSlug;
            $counter  = 1;

            // Tant que le slug existe déjà, ajoute -1, -2, etc.
            while (self::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $expenseCategory->slug = $slug;
        });

        // Optionnal: update the slug when to resources have the same
        static::updating(function ($expenseCategory) {
            if ($expenseCategory->isDirty('category')) {
                $baseSlug = Str::slug($expenseCategory->category);
                $slug     = $baseSlug;
                $counter  = 1;

                while (self::where('slug', $slug)->where('id', '!=', $expenseCategory->id)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                $expenseCategory->slug = $slug;
            }
        });
    }
    public function expense(): HasMany
    {
        return $this->hasMany(Expense::class);
    }
}
