<?php

namespace App\Livewire\Admin\TypeSections;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class TypeSectionList extends Component
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
    public function sections()
    {
        return \App\Models\ProductTypeSection::query()
            ->when($this->searchQuery, function ($query) {
                return $query->where('name', 'like', '%' . $this->searchQuery . '%');
            })
            ->latest()
            ->paginate(5);
    }

    public function render()
    {
        return view('livewire.admin.type-sections.type-section-list');
    }
}
