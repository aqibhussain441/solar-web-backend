<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\ProductCategory;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;

class PostForm extends Form
{


    public ?ProductCategory $category;

    #[Locked]
    public int|null $id;

    public string|null $name = '';

    public string|null $slug = '';

    public string|null $body = '';

    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:5',
                'max:255',
                // The name must be unique in the posts table, excluding the current category if editing.
                Rule::unique('posts')->ignore($this->category),
            ],
            'slug' => [
                'required',
                'min:5',
                'max:255',
                // The slug must be unique in the posts table, excluding the current category if editing.
                Rule::unique('posts')->ignore($this->category),
            ],
            'body' => 'required|min:5', // The body must be required and have a minimum length of 5 characters.
        ];
    }

    public function initializeForm(ProductCategory $category)
    {
        $this->category = $category;
        $this->fill($category->only('id', 'name', 'slug', 'body'));
    }

    public function save()
    {
        $this->validate();
        $this->category->fill($this->only('name', 'slug', 'body'));
        $this->category->save();
        $this->reset();
    }
}
