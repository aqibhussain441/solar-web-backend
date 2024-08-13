<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\ProductGroup;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;

class ProductGroupForm extends Form
{
    public ?ProductGroup $group;

    #[Locked]
    public int|null $id;

    public string|null $name = '';

    public string|int|null $order;

    public null|bool $is_active = true;

    public string|null $slug = '';

    public array|null $products = [];

    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:5',
                'max:255',
                Rule::unique(ProductGroup::class)->ignore($this->group),
            ],
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
            'slug' => [
                'required',
                'min:5',
                'max:255',
                Rule::unique(ProductGroup::class)->ignore($this->group),
            ],
            'products' => [
                'nullable',
                'array',
                'min:1',
                Rule::exists('products', 'id')->where(function ($query) {
                    $query->where('is_active', true);
                }),
            ]
        ];
    }


    public function initializeForm(ProductGroup $group)
    {
        $this->group = $group;
        $this->fill($group->only('id', 'name', 'slug', 'order', 'is_active'));
        $this->is_active = $group->is_active ?? false;
        $this->products = $group->products->pluck('id')->toArray();
    }

    public function save()
    {
        $this->validate();
        $this->group->fill($this->only('name', 'slug', 'order', 'is_active'));
        $this->group->save();
        $this->group->products()->sync($this->products);
        $this->reset(['name', 'slug', 'order', 'is_active', 'products']);
    }
}
