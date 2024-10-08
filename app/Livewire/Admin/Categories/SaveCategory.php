<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\ProductCategoryForm;
use Livewire\WithFileUploads;

class SaveCategory extends Component
{

    use WithFileUploads;
    public bool $showProductCategoryFormModal = false;

    public string $operation = '';

    public ProductCategoryForm $form;

    #[On('create-product-category')]
    public function createProductCategory()
    {
        $this->resetErrorBag();
        $this->operation = 'create';
        $this->form->initializeForm(new \App\Models\ProductCategory());
        $this->showProductCategoryFormModal = true;
    }

    #[On('edit-product-category')]
    public function editProductCategory($id)
    {
        $this->resetErrorBag();
        $this->operation = 'edit';
        $category = \App\Models\ProductCategory::find($id);
        $this->form->initializeForm($category);
        $this->showProductCategoryFormModal = true;
    }

    public function save()
    {
        $this->form->save();
        $this->showProductCategoryFormModal = false;
        $this->dispatch('refresh-product-category-list');
        $this->dispatch('toast', type: 'success', message: 'Product Category saved successfully.');
    }

    public function updatedFormName($value)
    {
        $this->form->slug = \Illuminate\Support\Str::slug($value);
    }
    public function updatedFormSlug($value)
    {
        $this->form->slug = \Illuminate\Support\Str::slug($value);
    }
    public function removeImage()
    {
        $this->form->removeImage();
    }
    public function render()
    {
        return view('livewire.admin.categories.save-category');
    }
}
