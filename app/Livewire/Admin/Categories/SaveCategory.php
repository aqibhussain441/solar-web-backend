<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\PostForm;


class SaveCategory extends Component
{


    public bool $showPostFormModal = false;

    public string $operation = '';

    public PostForm $form;

    #[On('create-post')]
    public function createPost()
    {
        $this->resetErrorBag();
        $this->operation = 'create';
        $this->form->initializeForm(new \App\Models\Post());
        $this->showPostFormModal = true;
    }

    #[On('edit-post')]
    public function editPost($id)
    {
        $this->resetErrorBag();
        $this->operation = 'edit';
        $post = \App\Models\Post::find($id);
        $this->form->initializeForm($post);
        $this->showPostFormModal = true;
    }

    public function save()
    {
        $this->form->save();
        $this->showPostFormModal = false;
        $this->dispatch('refresh-posts-list');
        $this->dispatch('toast', type: 'success', message: 'Post saved successfully.');
    }

    public function updatedFormTitle($value)
    {
        $this->form->slug = \Illuminate\Support\Str::slug($value);
    }

    public function render()
    {
        return view('livewire.admin.categories.save-category');
    }
}
