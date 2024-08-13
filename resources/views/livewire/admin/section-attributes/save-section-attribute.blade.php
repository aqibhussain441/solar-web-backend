<div>
    <x-button type="button" @click="$dispatch('create-type-section-attribute')" wire:loading.attr="disabled">
        {{ __('Add new') }}
    </x-button>
    <x-dialog-modal wire:model.live="showProductTypeSectionAttributeFormModal" maxWidth='2xl'>
        <x-slot name="title">
            @if ($operation === 'create')
                {{ __('Create a new attribute') }}
            @else
                {{ __('Edit attribute') }}
            @endif
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input type="text"
                    class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500"
                    placeholder="{{ __('Name') }}" wire:model="form.name" />
                <x-input-error for="name" class="mt-2" />
                <x-input-error for="form.name" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="type" value="{{ __('Type') }}" />
                <select wire:model.live="form.type"
                    class="border-gray-300 focus:border-indigo-500  block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500">
                    <option value="">{{ __('Select type') }}</option>
                    <option value="text">{{ __('Text') }}</option>
                    <option value="number">{{ __('Number') }}</option>
                    <option value="dropdown">{{ __('Dropdown') }}</option>
                    <option value="checkbox">{{ __('Checkbox') }}</option>
                    <option value="radio">{{ __('Radio') }}</option>
                    <option value="date">{{ __('Date') }}</option>
                    <option value="color">{{ __('Color') }}</option>
                    <option value="file">{{ __('File') }}</option>
                    <option value="editor">{{ __('Editor') }}</option>
                    <option value="rating">{{ __('Rating') }}</option>
                </select>
                <x-input-error for="type" class="mt-2" />
                <x-input-error for="form.type" class="mt-2" />
            </div>
            @if (in_array($form->type, ['dropdown', 'checkbox', 'radio']))
                <div class="mt-4">
                    <x-label for="options" value="{{ __('Options') }}" />
                    <small>write comma separated values</small>
                    <textarea type="text"
                        class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500"
                        placeholder="{{ __('Options') }}" wire:model="form.options"></textarea>
                    <x-input-error for="options" class="mt-2" />
                    <x-input-error for="form.options" class="mt-2" />
                </div>
            @endif

            @switch($form->type)
                @case('number')
                    <div class="mt-4">
                        <x-label for="default_value" value="{{ __('Default Value') }}" />
                        <x-input type="number"
                            class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500"
                            placeholder="{{ __('Default Value') }}" wire:model="form.default_value" />
                        <x-input-error for="default_value" class="mt-2" />
                        <x-input-error for="form.default_value" class="mt-2" />
                    </div>
                @break

                @case('color')
                    <div class="mt-4">
                        <x-label for="default_value" value="{{ __('Default Value') }}" />
                        <x-input type="color" class="" placeholder="{{ __('Default Value') }}"
                            wire:model="form.default_value" />
                        <x-input-error for="default_value" class="mt-2" />
                        <x-input-error for="form.default_value" class="mt-2" />
                    </div>
                @break

                @case('date')
                    <div class="mt-4">
                        <x-label for="default_value" value="{{ __('Default Value') }}" />
                        <x-input type="date"
                            class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500"
                            placeholder="{{ __('Default Value') }}" wire:model="form.default_value" />
                        <x-input-error for="default_value" class="mt-2" />
                        <x-input-error for="form.default_value" class="mt-2" />
                    </div>
                @break

                @case('editor')
                    <div class="mt-4">
                        <x-label for="default_value" value="{{ __('Default Value') }}" />
                        <x-quill-editor wire:model="form.default_value" />
                        <x-input-error for="default_value" class="mt-2" />
                        <x-input-error for="form.default_value" class="mt-2" />
                    </div>
                @break

                @case('rating')
                    <div class="mt-4">
                        <x-label for="default_value" value="{{ __('Default Value') }}" />
                        <x-input type="number" min="1" max="5"
                            class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500"
                            placeholder="{{ __('Default Value') }}" wire:model="form.default_value" />
                        <x-input-error for="default_value" class="mt-2" />
                        <x-input-error for="form.default_value" class="mt-2" />
                    </div>
                @break

                @default
                    <div class="mt-4">
                        <x-label for="default_value" value="{{ __('Default Value') }}" />
                        <x-input type="text"
                            class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500"
                            placeholder="{{ __('Default Value') }}" wire:model="form.default_value" />
                        <x-input-error for="default_value" class="mt-2" />
                        <x-input-error for="form.default_value" class="mt-2" />
                    </div>
            @endswitch

            <div class="mt-4">
                <x-label for="is_active" value="{{ __('Is Active') }}" />
                <x-input type="checkbox" class="form-checkbox text-indigo-600" wire:model="form.is_active" />
                <span class="ml-2">{{ __('Is Active') }}</span>
                <x-input-error for="is_active" class="mt-2" />
                <x-input-error for="form.is_active" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="is_required" value="{{ __('Is required?') }}" />
                <x-input type="checkbox" class="form-checkbox text-indigo-600" wire:model="form.is_required" />
                <span class="ml-2">{{ __('Is required?') }}</span>
                <x-input-error for="is_required" class="mt-2" />
                <x-input-error for="form.is_required" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="product_type_section_id" value="{{ __('Produt Type') }}" />
                <select wire:model="form.product_type_section_id"
                    class="border-gray-300 focus:border-indigo-500  block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500">
                    <option value="">{{ __('Select product type section') }}</option>
                    @foreach ($typeSections as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                <x-input-error for="product_type_section_id" class="mt-2" />
                <x-input-error for="form.product_type_section_id" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-label for="order" value="{{ __('Order') }}" />
                <x-input type="number"
                    class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500"
                    placeholder="{{ __('Order') }}" wire:model.blur="form.order" />
                <x-input-error for="order" class="mt-2" />
                <x-input-error for="form.order" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click.prevent="$toggle('showProductTypeSectionAttributeFormModal')"
                wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click.prevent='save' wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
