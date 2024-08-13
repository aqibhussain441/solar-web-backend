<?php

namespace App\Livewire\Admin\Groups;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\ProductGroupForm;
use Livewire\Attributes\Computed;

class SaveGroup extends Component
{

    public bool $showProductGroupFormModal = false;

    public string $operation = '';

    public ProductGroupForm $form;

    #[Computed]
    public function products()
    {
        return \App\Models\Product::query()->active()->pluck('name', 'id');
    }

    #[On('create-product-group')]
    public function createProductGroup()
    {
        $this->resetErrorBag();
        $this->operation = 'create';
        $this->form->initializeForm(new \App\Models\ProductGroup());
        $this->showProductGroupFormModal = true;
    }

    #[On('edit-product-group')]
    public function editProductGroup($id)
    {
        $this->resetErrorBag();
        $this->operation = 'edit';
        $group = \App\Models\ProductGroup::find($id);
        $this->form->initializeForm($group);
        $this->showProductGroupFormModal = true;
    }

    public function updatedFormName($value)
    {
        $this->form->slug = \Illuminate\Support\Str::slug($value);
    }
    public function updatedFormSlug($value)
    {
        $this->form->slug = \Illuminate\Support\Str::slug($value);
    }

    public function save()
    {
        $this->form->save();
        $this->showProductGroupFormModal = false;
        $this->dispatch('refresh-product-group-list');
        $this->dispatch('toast', type: 'success', message: 'Product Group saved successfully.');
    }

    public function render()
    {
        return view('livewire.admin.groups.save-group');
    }
}
