<?php

namespace App\Livewire\Admin\SubCategories;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class SubCategoryList extends Component
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
    public function subCategories()
    {
        return \App\Models\ProductSubCategory::query()
            ->when($this->searchQuery, function ($query) {
                return $query->where('name', 'like', '%' . $this->searchQuery . '%');
            })
            ->latest()
            ->paginate(5);
    }

    public function render()
    {
        return view('livewire.admin.sub-categories.sub-category-list');
    }
}
