<div x-data x-on:refresh-product-type-section-list.window="$wire.set('deleteModelId', null);$wire.$refresh();">
    <div class="flex justify-between items-center py-4">
        <h2 class="text-2xl">Categories</h2>
        {{-- Search filter start --}}
        <div class="relative w-64">
            <x-input type="text" placeholder="Search..." wire:model.live="searchQuery" />
        </div>
        <livewire:admin.type-sections.save-type-section />
    </div>
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">ID</th>
                    <th scope="col" class="py-3 px-6">Name</th>
                    <th scope="col" class="py-3 px-6">Order</th>
                    <th scope="col" class="py-3 px-6">Product type</th>
                    <th scope="col" class="py-3 px-6">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($this->sections as $section)
                    <tr wire:key='{{ $section->id }}' class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="p-2 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $section->id }}
                        </th>
                        <td class="p-2">
                            {{ Str::words($section->name, 5, '...') }}
                        </td>
                        <td class="p-1">
                            {{ $section->productType?->name }}
                        </td>
                        <td class="p-1">
                            {{ $section->order }}
                        </td>

                        <td class="p-2">
                            <x-button type="button"
                                @click="$dispatch('edit-product-type-section', { id: {{ $section->id }} })"
                                wire:loading.attr="disabled">
                                {{ __('Edit') }}
                            </x-button>
                            <x-danger-button type="button" wire:click="$set('deleteModelId', {{ $section->id }})"
                                wire:loading.attr="disabled">
                                {{ __('Delete') }}
                            </x-danger-button>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class=" border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
            {{ $this->sections->links() }}
        </div>
    </div>

    <x-dialog-modal wire:model.live="deleteModelId">
        <x-slot name="title">
            {{ __('Delete Post') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete') }}

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('deleteModelId', null)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3"
                wire:click="$dispatch('delete-product-type-section', { id: {{ $deleteModelId }} })"
                wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
