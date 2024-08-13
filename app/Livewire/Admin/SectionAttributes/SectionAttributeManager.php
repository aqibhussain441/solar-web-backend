<?php

namespace App\Livewire\Admin\SectionAttributes;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ProductTypeSectionAttribute;

class SectionAttributeManager extends Component
{
    #[On('delete-type-section-attribute')]
    public function deleteProductTypeSectionAttribute($id)
    {
        $productTypeSectionAttribute = ProductTypeSectionAttribute::find($id);

        if (!$productTypeSectionAttribute) {
            $this->dispatch('refresh-type-section-attribute-list');
            $this->dispatch('toast', type: 'error', message: 'Attribute not found!');
            return;
        }
        $productTypeSectionAttribute->delete();

        $this->dispatch('refresh-type-section-attribute-list');
        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Attribute deleted successfully!'
        );
    }

    public function render()
    {
        return view('livewire.admin.section-attributes.section-attribute-manager');
    }
}
