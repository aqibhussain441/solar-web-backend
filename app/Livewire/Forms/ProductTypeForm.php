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
        ];
    }


    public function initializeForm(ProductType $type)
    {
        $this->type = $type;
        $this->fill($type->only('id', 'name', 'slug', 'description'));
    }

    public function save()
    {
        $this->validate();

        $this->type->fill($this->only('name', 'slug', 'description'));

        $this->type->save();
        $this->reset(['name', 'slug', 'description']);
    }
}
