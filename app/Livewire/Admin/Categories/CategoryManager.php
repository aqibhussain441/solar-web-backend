<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;

class CategoryManager extends Component
{
    #[On('delete-product-category')]
    public function deleteProductCategory($id)
    {
        $productCategory = ProductCategory::find($id);

        if (!$productCategory) {
            $this->dispatch('refresh-product-category-list');
            $this->dispatch('toast', type: 'error', message: 'Category not found!');
            return;
        }
        if ($productCategory->image) {
            Storage::disk('public')->delete($productCategory->image);
            Storage::disk('public')->delete($productCategory->thumbnail);
        }
        $productCategory->delete();

        $this->dispatch('refresh-product-category-list');
        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Category deleted successfully!'
        );
    }

    public function render()
    {
        return view('livewire.admin.categories.category-manager');
    }
}
