<div>
    <x-button type="button" @click="$dispatch('create-product-group')" wire:loading.attr="disabled">
        {{ __('Add new') }}
    </x-button>
    <x-dialog-modal wire:model.live="showProductGroupFormModal" maxWidth='2xl'>
        <x-slot name="title">
            @if ($operation === 'create')
                {{ __('Create a new group') }}
            @else
                {{ __('Edit group') }}
            @endif
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input type="text"
                    class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500"
                    placeholder="{{ __('Name') }}" wire:model.blur="form.name" />
                <x-input-error for="name" class="mt-2" />
                <x-input-error for="form.name" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="slug" value="{{ __('Slug') }}" />
                <x-input type="text"
                    class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500"
                    placeholder="{{ __('Slug') }}" wire:model.blur="form.slug" />
                <x-input-error for="slug" class="mt-2" />
                <x-input-error for="form.slug" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="order" value="{{ __('Order') }}" />
                <x-input type="text"
                    class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500"
                    placeholder="{{ __('Order') }}" wire:model.blur="form.order" />
                <x-input-error for="order" class="mt-2" />
                <x-input-error for="form.order" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="products" value="{{ __('Products?') }}" />
                <x-searchable-multi-select :options="$this->products" name="my_select" wire:model="form.products" />

                <x-input-error for="form.is_active" class="mt-2" />
            </div>
            <div class="my-4">
                <x-label for="is_active" value="{{ __('Is Active?') }}" />
                <input type="checkbox" class="" id="form.is_active" wire:model="form.is_active" />
                <x-input-error for="form.is_active" class="mt-2" />
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click.prevent="$toggle('showProductGroupFormModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click.prevent='save' wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
