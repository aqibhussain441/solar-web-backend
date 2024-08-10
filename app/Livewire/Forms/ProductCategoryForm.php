<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Post;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;

class ProductCategoryForm extends Form
{

    public ?Post $post;

    #[Locked]
    public int|null $id;

    public string|null $title = '';

    public string|null $slug = '';

    public string|null $body = '';

    public function rules()
    {
        return [
            'title' => [
                'required',
                'min:5',
                'max:255',
                Rule::unique('posts')->ignore($this->post),
            ],
            'slug' => [
                'required',
                'min:5',
                'max:255',
                Rule::unique('posts')->ignore($this->post),
            ],
            'body' => 'required|min:5',
        ];
    }


    public function initializeForm(Post $post)
    {
        $this->post = $post;
        $this->fill($post->only('id', 'title', 'slug', 'body'));
    }

    public function save()
    {
        $this->validate();
        $this->post->fill($this->only('title', 'slug', 'body'));
        $this->post->save();
        $this->reset();
    }
}
