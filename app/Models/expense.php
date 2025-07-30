<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'amount', 'payment_date', 'activity_id', 'supplier_id', 'expense_type_id', 'expense_category_id'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($expense) {
            $baseSlug = Str::slug($expense->name);
            $slug     = $baseSlug;
            $counter  = 1;

            // Tant que le slug existe déjà, ajoute -1, -2, etc.
            while (self::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $expense->slug = $slug;
        });

        // Optionnal: update the slug when to resources have the same name
        static::updating(function ($expense) {
            if ($expense->isDirty('name')) {
                $baseSlug = Str::slug($expense->name);
                $slug     = $baseSlug;
                $counter  = 1;

                while (self::where('slug', $slug)->where('id', '!=', $expense->id)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                $expense->slug = $slug;
            }
        });
    }
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
    public function expenseType(): BelongsTo
    {
        return $this->belongsTo(ExpenseType::class);
    }
    public function expenseCategory(): BelongsTo
    {
        return $this->belongsTo(ExpenseCategory::class);
    }
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'type', 'type', 'type_id');
    }

}
