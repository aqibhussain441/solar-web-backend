<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttribute extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'product_type_section_attribute_id', 'value'];
    // Relations
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function attribute(): BelongsTo
    {
        return $this->belongsTo(ProductTypeSectionAttribute::class, 'product_type_section_attribute_id');
    }
}
