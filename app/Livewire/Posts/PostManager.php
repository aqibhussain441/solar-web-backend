<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

class PostManager extends Component
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
        return view('livewire.posts.post-manager');
    }
}
