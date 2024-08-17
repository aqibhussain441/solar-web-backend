<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'is_active', 'image', 'thumbnail', 'details', 'add_in_footer'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'bool',
    ];

    public function subcategories(): HasMany
    {
        return $this->hasMany(ProductSubCategory::class);
    }

    public function scopeActive($query): Builder
    {
        return $query->where('is_active', true);
    }
}
