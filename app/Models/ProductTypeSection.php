<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductTypeSection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'order',
        'description',
        'product_type_id',
        'is_active',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query): Builder
    {
        return $query->where('is_active', true);
    }

    public function product_type(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }

    public function section_attributes(): HasMany
    {
        return $this->hasMany(ProductTypeSectionAttribute::class);
    }
}
