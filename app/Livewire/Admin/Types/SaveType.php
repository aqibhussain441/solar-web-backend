<?php

namespace App\Livewire\Admin\Types;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\ProductTypeForm;
use Livewire\WithFileUploads;

class SaveType extends Component
{

    use WithFileUploads;
    public bool $showProductTypeFormModal = false;

    public string $operation = '';

    public ProductTypeForm $form;

    #[On('create-product-type')]
    public function createProductType()
    {
        $this->resetErrorBag();
        $this->operation = 'create';
        $this->form->initializeForm(new \App\Models\ProductType());
        $this->showProductTypeFormModal = true;
    }

    #[On('edit-product-type')]
    public function editProductType($id)
    {
        $this->resetErrorBag();
        $this->operation = 'edit';
        $type = \App\Models\ProductType::find($id);
        $this->form->initializeForm($type);
        $this->showProductTypeFormModal = true;
    }

    public function save()
    {
        $this->form->save();
        $this->showProductTypeFormModal = false;
        $this->dispatch('refresh-product-type-list');
        $this->dispatch('toast', type: 'success', message: 'Product Type saved successfully.');
    }

    public function updatedFormName($value)
    {
        $this->form->slug = \Illuminate\Support\Str::slug($value);
    }
    public function updatedFormSlug($value)
    {
        $this->form->slug = \Illuminate\Support\Str::slug($value);
    }

    public function render()
    {
        return view('livewire.admin.types.save-type');
    }
}
