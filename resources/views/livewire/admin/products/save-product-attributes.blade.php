<div>
    <x-dialog-modal wire:model.live="showProductAttributeFormModal" maxWidth='2xl'>
        <x-slot name="title">
            Product Attributes
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent='saveAttributes'>

                @if ($sections)
                    @foreach ($sections as $section)
                        <h4 class="font-bold text-xl">{{ $section->name }}</h4>
                        @foreach ($section->section_attributes as $attribute)
                            <div class="mb-4">
                                <x-label for="{{ $attribute->name }}" value="{{ $attribute->name }}" />

                                @switch($attribute->type)
                                    @case('select')
                                        <select wire:model="attributeValues.{{ $attribute->id }}" class="input">
                                            @foreach ($attribute->options as $option)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endforeach
                                        </select>
                                    @break

                                    @case('email')
                                        <x-input type="email" wire:model="attributeValues.{{ $attribute->id }}"
                                            class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500" />
                                    @break

                                    @case('checkbox')
                                        <x-input type="checkbox" wire:model="attributeValues.{{ $attribute->id }}"
                                            class="input" value="1" />
                                    @break

                                    @case('date')
                                        <x-input type="date" wire:model="attributeValues.{{ $attribute->id }}"
                                            class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500" />
                                    @break

                                    @case('color')
                                        <x-input type="color" wire:model="attributeValues.{{ $attribute->id }}"
                                            class="input" />
                                    @break

                                    @case('file')
                                        <x-input type="file" wire:model="attributeValues.{{ $attribute->id }}"
                                            class="input" />
                                    @break

                                    @default
                                        <x-input type="email" wire:model="attributeValues.{{ $attribute->id }}"
                                            class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500" />
                                @endswitch
                                <x-input-error for="{{ $attribute->name }}" class="mt-2" />
                            </div>
                        @endforeach
                    @endforeach
                @endif
            </form>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click.prevent="$toggle('showProductAttributeFormModal')"
                wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click.prevent='saveAttributes' wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
