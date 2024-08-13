<?php

namespace App\Livewire\Admin\Types;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ProductType;

class TypeManager extends Component
{
    #[On('delete-product-type')]
    public function deleteProductType($id)
    {
        $productType = ProductType::find($id);

        if (!$productType) {
            $this->dispatch('refresh-product-type-list');
            $this->dispatch('toast', type: 'error', message: 'Type not found!');
            return;
        }

        $productType->delete();

        $this->dispatch('refresh-product-type-list');
        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Type deleted successfully!'
        );
    }

    public function render()
    {
        return view('livewire.admin.types.type-manager');
    }
}
