<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\ProductType;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;

class ProductTypeForm extends Form
{
    public ?ProductType $type;

    #[Locked]
    public int|null $id;

    public string|null $name = '';

    public string|null $slug = '';

    public string|null $description = '';

    public null|bool $is_active = false;

    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:5',
                'max:255',
                Rule::unique(ProductType::class)->ignore($this->type),
            ],
            'slug' => [
                'required',
                'min:5',
                'max:255',
                Rule::unique(ProductType::class)->ignore($this->type),
            ],
            'description' => 'required|min:5',
            'is_active' => 'required|bool',
        ];
    }


    public function initializeForm(ProductType $type)
    {
        $this->type = $type;
        $this->fill($type->only('id', 'name', 'slug', 'description'));
        $this->is_active = $type->is_active ?? false;
    }

    public function save()
    {
        $this->validate();

        $this->type->fill($this->only('name', 'slug', 'description', 'is_active'));

        $this->type->save();
        $this->reset(['name', 'slug', 'description', 'is_active']);
    }
}
