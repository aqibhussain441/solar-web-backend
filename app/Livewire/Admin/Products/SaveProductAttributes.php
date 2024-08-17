<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductTypeSection;
use App\Models\ProductTypeSectionAttribute;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Features\SupportAttributes\AttributeCollection;

class SaveProductAttributes extends Component
{
    public Product $product;
    public Collection $sections;
    public Collection $customeAttributes;
    public array $attributeValues = [];

    public bool $showProductAttributeFormModal = false;

    #[On('showProductSectionAttribute')]
    public function initializeAttributes(Product $product, $product_type_id = null)
    {
        $this->product = $product;

        // Load sections based on the product's type
        $this->sections = ProductTypeSection::where('product_type_id', $product_type_id)->get();

        $this->customeAttributes = new Collection();

        foreach ($this->sections as $section) {
            $sectionAttributes = $section->section_attributes()->where('is_active', true)->orderBy('order')->get();
            $this->customeAttributes = $this->customeAttributes->merge($sectionAttributes);

            foreach ($sectionAttributes as $attribute) {
                $existingValue = $this->product->product_attributes()->where('product_type_section_attribute_id', $attribute->id)->first();
                $this->attributeValues[$attribute->id] = $existingValue->value ?? $attribute->default_value;
            }
        }
        $this->showProductAttributeFormModal = true;
    }

    public function saveAttributes()
    {
        $this->validate([
            'attributeValues.*' => 'required', // Customize validation based on attribute type
        ]);

        foreach ($this->attributeValues as $attributeId => $value) {
            $this->product->product_attributes()->updateOrCreate(
                ['product_type_section_attribute_id' => $attributeId],
                ['value' => $value]
            );
        }
        $this->reset();
        $this->dispatch('toast', type: 'success', message: 'Product attributes saved successfully!');
        $this->showProductAttributeFormModal = false;
    }

    public function render()
    {
        return view('livewire.admin.products.save-product-attributes');
    }
}
