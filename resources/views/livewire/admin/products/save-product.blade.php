<div>
    <x-button type="button" @click="$dispatch('create-product')" wire:loading.attr="disabled">
        {{ __('Add new') }}
    </x-button>
    <x-dialog-modal wire:model.live="showProductFormModal" maxWidth='2xl'>
        <x-slot name="title">
            @if ($operation === 'create')
                {{ __('Create a new product') }}
            @else
                {{ __('Edit Product') }}
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
                    {{-- Product type id --}}
                    <x-label for="product_type_id" value="{{ __('Product Type') }}" />
                    <select wire:model.live="form.product_type_id"
                        class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500">
                        <option value="">Select Product Type</option>
                        @foreach ($productTypes as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="product_type_id" class="mt-2" />
                    <x-input-error for="form.product_type_id" class="mt-2" />
                </div>
                <div class="mt-4">
                    {{-- Product type id --}}
                    <x-label for="product_category_id" value="{{ __('Product Category') }}" />
                    <select wire:model.live="form.product_category_id"
                        class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500">
                        <option value="">Select Category</option>
                        @foreach (\App\Models\ProductCategory::pluck('name', 'id') as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="slug" class="mt-2" />
                    <x-input-error for="form.slug" class="mt-2" />
                </div>
                @if ($form->product_category_id)
                    <div class="mt-4">
                        <x-label for="product_sub_category_id" value="{{ __('Product Sub Category') }}" />
                        <select wire:model="form.product_sub_category_id"
                            class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500">
                            <option value="">Select Sub Category</option>
                            @foreach (\App\Models\ProductSubCategory::where('product_category_id', $form->product_category_id)->pluck('name', 'id') as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="mt-4">
                    <x-label for="price" value="{{ __('Price') }}" />
                    <x-input type="number" step="0.01"
                        class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500"
                        placeholder="{{ __('Price') }}" wire:model="form.price" />
                    <x-input-error for="price" class="mt-2" />
                    <x-input-error for="form.price" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-label for="weight" value="{{ __('Weight') }}" />
                    <x-input type="number" step="0.01"
                        class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500"
                        placeholder="{{ __('Weight') }}" wire:model="form.weight" />
                    <x-input-error for="weight" class="mt-2" />
                    <x-input-error for="form.weight" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-label for="dimensions" value="{{ __('Dimensions') }}" />
                    <x-input type="text"
                        class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500"
                        placeholder="{{ __('dimensions') }}" wire:model="form.dimensions" />
                    <x-input-error for="dimensions" class="mt-2" />
                    <x-input-error for="form.dimensions" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-file-input type="text" name="main_image" removeMethod="removeImage"
                        class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500"
                        placeholder="{{ __('Main Image') }}" wire:model="form.main_image" />
                </div>
                <div class="mt-4">
                    <x-label for="description" value="{{ __('Description') }}" />
                    <x-quill-editor wire:model="form.description" />
                    <x-input-error for="description" class="mt-2" />
                    <x-input-error for="form.description" class="mt-2" />
                </div>
                <div class="flex md:flex-row flex-col">
                    <div class="flex-1">
                        <div class="mt-4">
                            <x-label for="add_in_footer" value="{{ __('Add in footer') }}" />
                            <x-input type="checkbox" class="form-checkbox text-indigo-600"
                                wire:model="form.add_in_footer" />
                            <span class="ml-2">{{ __('Add in footer') }}</span>
                            <x-input-error for="add_in_footer" class="mt-2" />
                            <x-input-error for="form.add_in_footer" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mt-4">
                            <x-label for="is_active" value="{{ __('Is Active') }}" />
                            <x-input type="checkbox" class="form-checkbox text-indigo-600"
                                wire:model="form.is_active" />
                            <span class="ml-2">{{ __('Is Active') }}</span>
                            <x-input-error for="is_active" class="mt-2" />
                            <x-input-error for="form.is_active" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex-1">

                        <div class="mt-4">
                            <x-label for="show_latest" value="{{ __('Show latest') }}" />
                            <x-input type="checkbox" class="form-checkbox text-indigo-600"
                                wire:model="form.show_latest" />
                            <span class="ml-2">{{ __('Show latest') }}</span>
                            <x-input-error for="show_latest" class="mt-2" />
                            <x-input-error for="form.show_latest" class="mt-2" />
                        </div>
                    </div>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click.prevent="$toggle('showProductFormModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click.prevent='save' wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
