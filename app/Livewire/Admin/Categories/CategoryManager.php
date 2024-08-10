<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoryManager extends Component
{
    #[On('delete-post')]
    public function deletePost($id)
    {
        $post = Post::find($id);

        if (!$post) {
            $this->dispatch('refresh-posts-list');
            $this->dispatch('toast', type: 'error', message: 'Post not found!');
            return;
        }

        $post->delete();

        $this->dispatch('refresh-posts-list');
        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Post deleted successfully!'
        );
    }

    public function render()
    {
        return view('livewire.admin.categories.category-manager');
    }
}
