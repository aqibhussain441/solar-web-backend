<div>
    <x-button type="button" @click="$dispatch('create-product-sub-category')" wire:loading.attr="disabled">
        {{ __('Add new') }}
    </x-button>
    <x-dialog-modal wire:model.live="showProductSubCategoryFormModal" maxWidth='2xl'>
        <x-slot name="title">
            @if ($operation === 'create')
                {{ __('Create a new sub category') }}
            @else
                {{ __('Edit sub category') }}
            @endif
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent='save'>

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
                    <x-label for="product_category_id" value="{{ __('Parent Category') }}" />
                    <select wire:model="form.product_category_id"
                        class="border-gray-300 focus:border-indigo-500  block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500">
                        <option value="">{{ __('Select parent category') }}</option>
                        @foreach ($categories as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="product_category_id" class="mt-2" />
                    <x-input-error for="form.product_category_id" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-file-input type="text" name="image" removeMethod="removeImage"
                        class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500"
                        placeholder="{{ __('Slug') }}" wire:model="form.image" />
                </div>
                <div class="mt-4">
                    <x-label for="details" value="{{ __('Details') }}" />
                    <x-quill-editor wire:model="form.details" />
                    <x-input-error for="details" class="mt-2" />
                    <x-input-error for="form.details" class="mt-2" />
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click.prevent="$toggle('showProductSubCategoryFormModal')"
                wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click.prevent='save' wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
