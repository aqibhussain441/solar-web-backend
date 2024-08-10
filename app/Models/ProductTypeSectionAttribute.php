<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
        'required',
        'is_active',
        'order',
        'default_value',
    ];

    public function productTypeSection(): BelongsTo
    {
        return $this->belongsTo(ProductTypeSection::class);
    }
    public function attributeValues(): HasMany
    {
        return $this->hasMany(ProductAttribute::class);
    }
}
