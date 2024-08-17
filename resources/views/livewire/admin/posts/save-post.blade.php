<div>
    <x-button type="button" @click="$dispatch('create-post')" wire:loading.attr="disabled">
        {{ __('Create post') }}
    </x-button>
    <x-dialog-modal wire:model.live="showPostFormModal" maxWidth='2xl'>
        <x-slot name="title">
            @if ($operation === 'create')
                {{ __('Create a new post') }}
            @else
                {{ __('Edit post') }}
            @endif
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent='save'>
                <div class="mt-4">
                    <x-label for="title" value="{{ __('Title') }}" />
                    <x-input type="text"
                        class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500"
                        placeholder="{{ __('Title') }}" atuofocus='false' wire:model.blur="form.title" />
                    <x-input-error for="title" class="mt-2" />
                    <x-input-error for="form.title" class="mt-2" />
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
                    <x-label for="body" value="{{ __('Body') }}" />
                    <textarea class="block w-full px-3 py-2 text-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500"
                        rows="10" placeholder="{{ __('Body') }}" wire:model="form.body"></textarea>

                    <x-input-error for="body" class="mt-2" />
                    <x-input-error for="form.body" class="mt-2" />
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click.prevent="$toggle('showPostFormModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click.prevent='save' wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
