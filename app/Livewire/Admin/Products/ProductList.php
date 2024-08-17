<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public int|null $deleteModelId;

    #[Url(as: 'search', except: '')]
    public string|null $searchQuery = '';

    public function updatedSearchQuery()
    {
        $this->resetPage();
    }
    #[Computed]
    public function products()
    {
        return \App\Models\Product::query()
            ->when($this->searchQuery, function ($query) {
                return $query->where('name', 'like', '%' . $this->searchQuery . '%');
            })
            ->latest()
            ->paginate(20);
    }

    public function render()
    {
        return view('livewire.admin.products.product-list');
    }
}
