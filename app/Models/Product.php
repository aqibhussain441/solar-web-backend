<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'dimensions',
        'weight',
        'images',
        'product_type_id',
        'is_active',
        'show_latest',
        'description',
    ];

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(ProductSubCategory::class);
    }
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(ProductGroup::class, 'product_group_product');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class);
    }
}
