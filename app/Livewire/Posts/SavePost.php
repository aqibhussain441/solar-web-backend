<?php

namespace App\Livewire\Posts;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\PostForm;

/**
 * A Livewire component for saving posts.
 *
 * This component handles the creation and editing of posts. It listens for events 'create-post' and 'edit-post'
 * and performs the corresponding actions. It also updates the slug property of the PostForm when the title changes.
 *
 * @property bool $showPostFormModal Indicates whether the post form modal should be shown.
 * @property string $operation The current operation being performed (create or edit).
 * @property PostForm $form The PostForm instance used for handling post data.
 */
class SavePost extends Component
{

    /**
     * @property bool $showPostFormModal Indicates whether the post form modal should be shown.
     */
    public bool $showPostFormModal = false;

    /**
     * @property string $operation The current operation being performed (create or edit).
     */
    public string $operation = '';

    /**
     * @property PostForm $form The PostForm instance used for handling post data.
     */
    public PostForm $form;

    /**
     * Handles the creation of a new post.
     *
     * This function is triggered by the 'create-post' event. It sets the operation to 'create', initializes the PostForm with a new Post instance,
     * and shows the post form modal.
     *
     * @return void
     * @throws \Livewire\Exceptions\PropertyNotFoundException If the 'operation', 'form', or 'showPostFormModal' properties are not defined in the component.
     */
    #[On('create-post')]
    public function createPost()
    {
        $this->resetErrorBag();
        $this->operation = 'create';
        $this->form->initializeForm(new \App\Models\Post());
        $this->showPostFormModal = true;
    }

    /**
     * Handles the editing of an existing post.
     *
     * This function is triggered by the 'edit-post' event. It sets the operation to 'edit', retrieves the post with the given ID,
     * initializes the PostForm with the retrieved post, and shows the post form modal.
     *
     * @param int $id The ID of the post to be edited.
     * @return void
     * @throws \Livewire\Exceptions\PropertyNotFoundException If the 'operation', 'form', or 'showPostFormModal' properties are not defined in the component.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the post with the given ID does not exist.
     */
    #[On('edit-post')]
    public function editPost($id)
    {
        $this->resetErrorBag();
        $this->operation = 'edit';
        $post = \App\Models\Post::find($id);
        $this->form->initializeForm($post);
        $this->showPostFormModal = true;
    }

    /**
     * Saves the post data.
     *
     * This function is responsible for saving the post data to the database. It calls the save method of the PostForm instance,
     * hides the post form modal, dispatches the 'refresh-posts-list' event, and displays a success toast message.
     *
     * @return void
     * @throws \Livewire\Exceptions\MethodNotFoundException If the 'save' method is not defined in the PostForm class.
     * @throws \Livewire\Exceptions\PropertyNotFoundException If the 'showPostFormModal' or 'form' properties are not defined in the component.
     */
    public function save()
    {
        $this->form->save();
        $this->showPostFormModal = false;
        $this->dispatch('refresh-posts-list');
        $this->dispatch('toast', type: 'success', message: 'Post saved successfully.');
    }

    /**
     * Updates the slug property of the PostForm instance when the title changes.
     *
     * This function is triggered by the 'updatedFormTitle' event. It uses the Laravel Str::slug helper to generate a slug
     * from the given title value and updates the slug property of the PostForm instance.
     *
     * @param string $value The new title value.
     * @return void
     * @throws \Livewire\Exceptions\PropertyNotFoundException If the 'form' property is not defined in the component.
     */
    public function updatedFormTitle($value)
    {
        $this->form->slug = \Illuminate\Support\Str::slug($value);
    }


    /**
     * Renders the Livewire component view.
     *
     * This function is responsible for returning the view that should be displayed when the SavePost component is rendered.
     * It uses Laravel's view() function to specify the path to the view file 'livewire.posts.save-post'.
     *
     * @return \Illuminate\View\View The view to be rendered.
     */
    public function render()
    {
        return view('livewire.posts.save-post');
    }
}
