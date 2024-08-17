<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'slug',
        'price',
        'dimensions',
        'weight',
        'main_image',
        'main_thumbnail',
        'product_type_id',
        'product_sub_category_id',
        'is_active',
        'show_latest',
        'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'add_in_footer' => 'boolean',
        'show_latest' => 'boolean',
    ];

    public function scopeActive($query): Builder
    {
        return $query->where('is_active', true);
    }
    public function sub_category(): BelongsTo
    {
        return $this->belongsTo(ProductSubCategory::class, 'product_sub_category_id');
    }
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(ProductGroup::class, 'product_group_product');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function product_attributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class);
    }
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function delete()
    {
        if (Storage::disk('public')->exists($this->main_image)) {
            Storage::disk('public')->delete($this->main_image);
        }
        if (Storage::disk('public')->exists($this->main_thumbnail)) {
            Storage::disk('public')->delete($this->main_thumbnail);
        }
        parent::delete();
    }
}
