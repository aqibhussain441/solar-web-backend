<?php

namespace App\Livewire\Admin\SubCategories;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ProductSubCategory;
use Illuminate\Support\Facades\Storage;

class SubCategoryManager extends Component
{
    #[On('delete-sub-product-category')]
    public function deleteProductCategory($id)
    {
        $productSubCategory = ProductSubCategory::find($id);

        if (!$productSubCategory) {
            $this->dispatch('refresh-sub-product-category-list');
            $this->dispatch('toast', type: 'error', message: 'Category not found!');
            return;
        }
        if ($productSubCategory->image) {
            Storage::disk('public')->delete($productSubCategory->image);
            Storage::disk('public')->delete($productSubCategory->thumbnail);
        }
        $productSubCategory->delete();

        $this->dispatch('refresh-sub-product-category-list');
        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Category deleted successfully!'
        );
    }

    public function render()
    {
        return view('livewire.admin.sub-categories.sub-category-manager');
    }
}
