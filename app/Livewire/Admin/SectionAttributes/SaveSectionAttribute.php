<?php

namespace App\Livewire\Admin\SectionAttributes;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\ProductTypeSectionAttributeForm;
use App\Models\ProductTypeSection;

class SaveSectionAttribute extends Component
{

    public bool $showProductTypeSectionAttributeFormModal = false;

    public string $operation = '';

    public ProductTypeSectionAttributeForm $form;


    #[Computed]
    public function typeSections(): array
    {
        return ProductTypeSection::active()->pluck('name', 'id')->toArray();
    }

    #[On('create-type-section-attribute')]
    public function createProductTypeSectionAttribute()
    {
        $this->resetErrorBag();
        $this->operation = 'create';
        $this->form->initializeForm(new \App\Models\ProductTypeSectionAttribute());
        $this->showProductTypeSectionAttributeFormModal = true;
    }

    #[On('edit-type-section-attribute')]
    public function editProductTypeSectionAttribute($id)
    {
        $this->resetErrorBag();
        $this->operation = 'edit';
        $category = \App\Models\ProductTypeSectionAttribute::find($id);
        $this->form->initializeForm($category);
        $this->showProductTypeSectionAttributeFormModal = true;
    }

    public function save()
    {
        $this->form->save();
        $this->showProductTypeSectionAttributeFormModal = false;
        $this->dispatch('refresh-type-section-attribute-list');
        $this->dispatch('toast', type: 'success', message: 'Attribute saved successfully.');
    }

    public function updatedFormType()
    {
        $this->form->default_value = '';
    }

    public function render()
    {
        return view('livewire.admin.section-attributes.save-section-attribute');
    }
}
