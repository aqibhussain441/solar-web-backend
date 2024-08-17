<div>
    <x-button type="button" @click="$dispatch('create-product-category')" wire:loading.attr="disabled">
        {{ __('Add new') }}
    </x-button>
    <x-dialog-modal wire:model.live="showProductCategoryFormModal" maxWidth='2xl'>
        <x-slot name="title">
            @if ($operation === 'create')
                {{ __('Create a new category') }}
            @else
                {{ __('Edit category') }}
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
                    <x-file-input type="text" name="image" removeMethod="removeImage"
                        class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500"
                        placeholder="{{ __('Slug') }}" wire:model="form.image" />
                </div>
                <div class="flex-1">
                    <div class="mt-4">
                        <x-label for="is_active" value="{{ __('Is Active') }}" />
                        <x-input type="checkbox" class="form-checkbox text-indigo-600" wire:model="form.is_active" />
                        <span class="ml-2">{{ __('Is Active') }}</span>
                        <x-input-error for="is_active" class="mt-2" />
                        <x-input-error for="form.is_active" class="mt-2" />
                    </div>
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
            <x-secondary-button wire:click.prevent="$toggle('showProductCategoryFormModal')"
                wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click.prevent='save' wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
