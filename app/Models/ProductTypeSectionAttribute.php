<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductTypeSectionAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_type_section_id',
        'name',
        'type',
        'options',
        'is_required',
        'is_active',
        'order',
        'default_value',
    ];

    protected function casts()
    {
        return [
            'options' => 'array',
        ];
    }
    public function productTypeSection(): BelongsTo
    {
        return $this->belongsTo(ProductTypeSection::class);
    }
    public function attributeValues(): HasMany
    {
        return $this->hasMany(ProductAttribute::class);
    }

    /**
     * Scope a query to only include active product subcategories.
     *
     * @param Builder $query The Eloquent query builder instance.
     * @return Builder The modified query builder instance with the active condition applied.
     */
    public function scopeActive($query): Builder
    {
        return $query->where('is_active', true);
    }
}
