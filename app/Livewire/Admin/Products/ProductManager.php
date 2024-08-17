<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Product;

class ProductManager extends Component
{
    #[On('delete-product')]
    public function deleteProduct($id)
    {
        $product = Product::find($id);

        if (!$product) {
            $this->dispatch('refresh-product-list');
            $this->dispatch('toast', type: 'error', message: 'Product not found!');
            return;
        }

        $product->delete();

        $this->dispatch('refresh-product-list');
        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Product deleted successfully!'
        );
    }

    public function render()
    {
        return view('livewire.admin.products.product-manager');
    }
}
