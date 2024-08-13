<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Post;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;

class PostForm extends Form
{


    public ?Post $post;

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
                // The name must be unique in the posts table, excluding the current post if editing.
                Rule::unique('posts')->ignore($this->post),
            ],
            'slug' => [
                'required',
                'min:5',
                'max:255',
                // The slug must be unique in the posts table, excluding the current post if editing.
                Rule::unique('posts')->ignore($this->post),
            ],
            'body' => 'required|min:5', // The body must be required and have a minimum length of 5 characters.
        ];
    }

    public function initializeForm(Post $post)
    {
        $this->post = $post;
        $this->fill($post->only('id', 'name', 'slug', 'body'));
    }

    public function save()
    {
        $this->validate();
        $this->post->fill($this->only('name', 'slug', 'body'));
        $this->post->save();
        $this->reset();
    }
}
