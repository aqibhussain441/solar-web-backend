<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Post;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;

class PostForm extends Form
{

    /**
     * The Post model instance to be edited. If not provided, a new Post instance will be created.
     */
    public ?Post $post;

    /**
     * The ID of the post. This property is automatically filled when editing an existing post.
     * The @Locked attribute prevents this property from being updated directly from the front-end.
     */
    #[Locked]
    public int|null $id;

    /**
     * The title of the post.
     */
    public string|null $title = '';

    /**
     * The slug of the post.
     */
    public string|null $slug = '';

    /**
     * The body of the post.
     */
    public string|null $body = '';

    /**
     * This function returns the validation rules for the PostForm properties.
     *
     * @return array An array of validation rules for the properties.
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                'min:5',
                'max:255',
                // The title must be unique in the posts table, excluding the current post if editing.
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

    /**
     * Initializes the PostForm with the provided Post model instance.
     *
     * This function sets the $post property to the provided Post model instance and fills the form properties
     * with the corresponding values from the Post model.
     *
     * @param Post $post The Post model instance to be edited. If not provided, a new Post instance will be created.
     *
     * @return void
     */
    public function initializeForm(Post $post)
    {
        $this->post = $post;
        $this->fill($post->only('id', 'title', 'slug', 'body'));
    }

    /**
     * Saves the current state of the PostForm to the database.
     *
     * This function performs the following actions:
     * 1. Validates the form data using the rules defined in the rules() method.
     * 2. Fills the Post model instance with the form data using the fill() method.
     * 3. Saves the updated Post model instance to the database using the save() method.
     * 4. Resets the form properties to their default values using the reset() method.
     *
     * @return void
     */
    public function save()
    {
        $this->validate();
        $this->post->fill($this->only('title', 'slug', 'body'));
        $this->post->save();
        $this->reset();
    }
}
