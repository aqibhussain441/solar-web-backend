<?php

namespace App\Livewire\Admin\SubCategories;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\ProductCategory;
use App\Livewire\Forms\ProductSubCategoryForm;
use Illuminate\Support\Collection;

class SaveSubCategory extends Component
{

    use WithFileUploads;
    public bool $showProductSubCategoryFormModal = false;

    public string $operation = '';

    public ProductSubCategoryForm $form;

    public array|null|Collection $categories;

    public function mount()
    {
        $this->categories = ProductCategory::pluck('name', 'id');
    }

    #[On('create-product-sub-category')]
    public function createProductCategory()
    {
        $this->resetErrorBag();
        $this->operation = 'create';
        $this->form->initializeForm(new \App\Models\ProductSubCategory());
        $this->showProductSubCategoryFormModal = true;
    }

    #[On('edit-product-sub-category')]
    public function editProductCategory($id)
    {
        $this->resetErrorBag();
        $this->operation = 'edit';
        $category = \App\Models\ProductSubCategory::find($id);
        $this->form->initializeForm($category);
        $this->showProductSubCategoryFormModal = true;
    }

    public function save()
    {
        $this->form->save();
        $this->showProductSubCategoryFormModal = false;
        $this->dispatch('refresh-product-sub-category-list');
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
        return view('livewire.admin.sub-categories.save-sub-category');
    }
}
