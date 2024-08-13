<?php

namespace App\Livewire\Admin\TypeSections;

use Livewire\Component;
use App\Models\ProductType;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use App\Livewire\Forms\ProductTypeSectionForm;

class SaveTypeSection extends Component
{

    public bool $showProductTypeSectionFormModal = false;

    public string $operation = '';

    public ProductTypeSectionForm $form;

    public array|null $types;

    public function mount()
    {
        $this->types = ProductType::pluck('name', 'id')->toArray();
    }

    #[On('create-product-type-section')]
    public function createProductTypeSection()
    {
        $this->resetErrorBag();
        $this->operation = 'create';
        $this->form->initializeForm(new \App\Models\ProductTypeSection());
        $this->showProductTypeSectionFormModal = true;
    }

    #[On('edit-product-type-section')]
    public function editProductTypeSection($id)
    {
        $this->resetErrorBag();
        $this->operation = 'edit';
        $category = \App\Models\ProductTypeSection::find($id);
        $this->form->initializeForm($category);
        $this->showProductTypeSectionFormModal = true;
    }

    public function save()
    {
        $this->form->save();
        $this->showProductTypeSectionFormModal = false;
        $this->dispatch('refresh-product-type-section-list');
        $this->dispatch('toast', type: 'success', message: 'Product Type Section saved successfully.');
    }

    public function render()
    {
        return view('livewire.admin.type-sections.save-type-section');
    }
}
