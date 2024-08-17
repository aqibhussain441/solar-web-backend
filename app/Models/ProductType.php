<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductType extends Model
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
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function sections(): HasMany
    {
        return $this->hasMany(ProductTypeSection::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function scopeActive($query): Builder
    {
        return $query->where('is_active', true);
    }
}
