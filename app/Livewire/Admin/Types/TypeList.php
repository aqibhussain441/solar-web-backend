<?php

namespace App\Livewire\Admin\Types;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class TypeList extends Component
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
    public function types()
    {
        return \App\Models\ProductType::query()
            ->when($this->searchQuery, function ($query) {
                return $query->where('name', 'like', '%' . $this->searchQuery . '%');
            })
            ->latest()
            ->paginate(5);
    }

    public function render()
    {
        return view('livewire.admin.types.type-list');
    }
}
