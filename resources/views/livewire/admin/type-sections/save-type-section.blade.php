<div>
    <x-button type="button" @click="$dispatch('create-product-type-section')" wire:loading.attr="disabled">
        {{ __('Add new') }}
    </x-button>
    <x-dialog-modal wire:model.live="showProductTypeSectionFormModal" maxWidth='2xl'>
        <x-slot name="title">
            @if ($operation === 'create')
                {{ __('Create a new section') }}
            @else
                {{ __('Edit section') }}
            @endif
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent='save'>

                <div class="mt-4">
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input type="text"
                        class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500"
                        placeholder="{{ __('Name') }}" wire:model="form.name" />
                    <x-input-error for="name" class="mt-2" />
                    <x-input-error for="form.name" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-label for="product_type_id" value="{{ __('Produt Type') }}" />
                    <select wire:model="form.product_type_id"
                        class="border-gray-300 focus:border-indigo-500  block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500">
                        <option value="">{{ __('Select product type') }}</option>
                        @foreach ($this->types as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="product_type_id" class="mt-2" />
                    <x-input-error for="form.product_type_id" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-label for="order" value="{{ __('Order') }}" />
                    <x-input type="number"
                        class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500"
                        placeholder="{{ __('Order') }}" wire:model.blur="form.order" />
                    <x-input-error for="order" class="mt-2" />
                    <x-input-error for="form.order" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-label for="is_active" value="{{ __('Is Active') }}" />
                    <x-input type="checkbox" class="form-checkbox text-indigo-600" wire:model="form.is_active" />
                    <span class="ml-2">{{ __('Is Active') }}</span>
                    <x-input-error for="is_active" class="mt-2" />
                    <x-input-error for="form.is_active" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-label for="description" value="{{ __('Description') }}" />
                    <x-quill-editor wire:model="form.description" />
                    <x-input-error for="description" class="mt-2" />
                    <x-input-error for="form.description" class="mt-2" />
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click.prevent="$toggle('showProductTypeSectionFormModal')"
                wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click.prevent='save' wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
