<?php

namespace App\Livewire\Admin\Groups;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ProductGroup;
use Illuminate\Support\Facades\Storage;

class GroupManager extends Component
{
    #[On('delete-product-group')]
    public function deleteProductGroup($id)
    {
        $productGroup = ProductGroup::find($id);

        if (!$productGroup) {
            $this->dispatch('refresh-product-group-list');
            $this->dispatch('toast', type: 'error', message: 'Category not found!');
            return;
        }

        $productGroup->delete();

        $this->dispatch('refresh-product-group-list');
        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Category deleted successfully!'
        );
    }

    public function render()
    {
        return view('livewire.admin.groups.group-manager');
    }
}
