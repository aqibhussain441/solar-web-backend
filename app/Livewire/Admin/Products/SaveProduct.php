<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\ProductForm;
use App\Models\ProductType;
use Livewire\WithFileUploads;

class SaveProduct extends Component
{

    use WithFileUploads;

    public bool $showProductFormModal = false;

    public string $operation = '';

    public ProductForm $form;

    public array $productTypes = [];

    public function mount()
    {
        $this->productTypes = ProductType::active()->pluck('name', 'id')->toArray();
    }

    #[On('create-product')]
    public function createProduct()
    {
        $this->resetErrorBag();
        $this->operation = 'create';
        $this->form->initializeForm(new \App\Models\Product());
        $this->showProductFormModal = true;
    }

    #[On('edit-product')]
    public function editProduct($id)
    {
        $this->resetErrorBag();
        $this->operation = 'edit';
        $product = \App\Models\Product::find($id);
        $this->form->initializeForm($product);
        $this->showProductFormModal = true;
    }

    public function save()
    {
        $this->form->save();
        $this->showProductFormModal = false;
        $this->dispatch('refresh-product-list');
        $this->dispatch('toast', type: 'success', message: 'Product saved successfully.');
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
    public function updatedFormProductCategoryId()
    {
        $this->form->product_sub_category_id = null;
    }
    public function render()
    {
        return view('livewire.admin.products.save-product');
    }
}
