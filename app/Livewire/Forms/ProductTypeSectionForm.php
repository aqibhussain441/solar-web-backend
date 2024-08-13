<?php

namespace App\Livewire\Forms;

use App\Models\ProductType;
use Livewire\Form;
use App\Models\ProductTypeSection;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;

class ProductTypeSectionForm extends Form
{

    public ?ProductTypeSection $typeSection;

    #[Locked]
    public int|null $id;

    public string|null $name = '';

    public string|null $description = '';

    public null|int $order;

    public null|int $product_type_id;

    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:5',
                'max:255',
                Rule::unique(ProductTypeSection::class)->ignore($this->typeSection),
            ],
            'order' => 'nullable|integer',
            'description' => 'required|min:5',
            'product_type_id' => [
                'required',
                Rule::exists(ProductType::class, 'id'),
            ]
        ];
    }

    public function initializeForm(ProductTypeSection $typeSection)
    {
        $this->typeSection = $typeSection;
        $this->fill($typeSection->only('id', 'order', 'name', 'description', 'product_type_id'));
    }

    public function save()
    {
        $this->validate();

        $this->typeSection->fill($this->only('name', 'description', 'order', 'product_type_id'));

        $this->typeSection->save();
        $this->reset(['name', 'description', 'order', 'product_type_id']);
    }
}
