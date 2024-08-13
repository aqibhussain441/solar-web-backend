<?php

namespace App\Livewire\Admin\TypeSections;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ProductTypeSection;

class TypeSectionManager extends Component
{
    #[On('delete-product-type-section')]
    public function deleteProductTypeSection($id)
    {
        $productTypeSection = ProductTypeSection::find($id);

        if (!$productTypeSection) {
            $this->dispatch('refresh-product-type-section-list');
            $this->dispatch('toast', type: 'error', message: 'Section not found!');
            return;
        }
        $productTypeSection->delete();

        $this->dispatch('refresh-product-type-section-list');
        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Section deleted successfully!'
        );
    }

    public function render()
    {
        return view('livewire.admin.type-sections.type-section-manager');
    }
}
