<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductTypeSection;
use App\Models\ProductTypeSectionAttribute;
use App\Models\ProductAttribute;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;

class ProductAttributeForm extends Form
{
    public Product $product;
    public Collection $sections;
    public Collection $attributes;
    public array $attributeValues = [];

    #[On('edit-product-attributes')]
    public function initializeAttributes(Product $product)
    {
        $this->product = $product;

        // Load sections based on the product's type
        $this->sections = ProductTypeSection::where('product_type_id', $product->product_type_id)->get();

        $this->attributes = collect();

        foreach ($this->sections as $section) {
            $sectionAttributes = $section->attributes()->where('is_active', true)->orderBy('order')->get();
            $this->attributes = $this->attributes->merge($sectionAttributes);

            foreach ($sectionAttributes as $attribute) {
                $existingValue = $this->product->attributes()->where('product_type_section_attribute_id', $attribute->id)->first();
                $this->attributeValues[$attribute->id] = $existingValue->value ?? $attribute->default_value;
            }
        }
    }

    public function saveAttributes()
    {
        $this->validate([
            'attributeValues.*' => 'required', // Customize validation based on attribute type
        ]);

        foreach ($this->attributeValues as $attributeId => $value) {
            $this->product->attributes()->updateOrCreate(
                ['product_type_section_attribute_id' => $attributeId],
                ['value' => $value]
            );
        }

        return true;
    }
}
