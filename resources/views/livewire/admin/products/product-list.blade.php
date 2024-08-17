<div x-data x-on:refresh-product-list.window="$wire.set('deleteModelId', null);$wire.$refresh();">
    <div class="flex justify-between items-center py-4">
        <h2 class="text-2xl">Products</h2>
        {{-- Search filter start --}}
        <div class="relative w-64">
            <x-input type="text" placeholder="Search..." wire:model.live="searchQuery" />
        </div>
        <livewire:admin.products.save-product />
    </div>
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">ID</th>
                    <th scope="col" class="py-3 px-6">Name</th>
                    <th scope="col" class="py-3 px-6">Image</th>
                    <th scope="col" class="py-3 px-6">Status</th>
                    <th scope="col" class="py-3 px-6">Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($this->products as $product)
                    <tr wire:key='{{ $product->id }}' class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="p-2 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $product->id }}
                        </th>
                        <td class="p-2">
                            {{ Str::words($product->name, 5, '...') }}
                        </td>
                        <td class="p-2">
                            <div class="">
                                <img class="w-12 h-12 object-cover rounded-md shadow-md"
                                    src="{{ \Storage::disk('public')->url($product->main_thumbnail) }}"
                                    alt="Product Thumbnail">
                            </div>
                        </td>
                        <td class="p-2 text-center">
                            @if ($product->is_active == 1)
                                <span class="px-2 py-1 text-green-500 bg-green-100 rounded-full">Active</span>
                            @else
                                <span class="px-2 py-1 text-red-500 bg-red-100 rounded-full">Inactive</span>
                            @endif
                        </td>

                        <td class="p-2">
                            <x-secondary-button type="button"
                                @click="$dispatch('showProductSectionAttribute', { product: {{ $product->id }}, product_type_id: {{ $product->product_type_id }} })"
                                wire:loading.attr="disabled">
                                {{ __('Attributes') }}
                            </x-secondary-button>

                            <x-button type="button" @click="$dispatch('edit-product', { id: {{ $product->id }} })"
                                wire:loading.attr="disabled">
                                {{ __('Edit') }}
                            </x-button>
                            <x-danger-button type="button" wire:click="$set('deleteModelId', {{ $product->id }})"
                                wire:loading.attr="disabled">
                                {{ __('Delete') }}
                            </x-danger-button>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class=" border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
            {{ $this->products->links() }}
        </div>
    </div>

    <x-dialog-modal wire:model.live="deleteModelId">
        <x-slot name="title">
            {{ __('Delete') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete') }}

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('deleteModelId', null)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="$dispatch('delete-product', { id: {{ $deleteModelId }} })"
                wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
