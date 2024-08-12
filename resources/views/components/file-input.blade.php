@props([
    'name',
    'disabled' => false,
    'removeMethod' => '',
    'removeParams' => '',
    'label' => null,
    'location' => null,
])

@php
    $model = $attributes->wire('model')->value();
    $class = 'hidden ' . ($errors->has($model) ? 'border-red-500' : '');
    $modelValue = data_get($this, $model);
    $isArray = is_array($modelValue);
    $removeParams = $removeParams ? ' ,' . $removeParams : '';
    $isMultiple = isset($attributes['multiple']) ? true : false;
    $location = 'storage/' . $location;
@endphp

<div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
    x-on:livewire-upload-finish="uploading = false;progress = 0"
    x-on:livewire-upload-cancel="uploading = false;progress = 0" x-on:livewire-upload-error="uploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress">

    <label
        class="block text-gray-700 font-medium">{{ $label ?? Str::ucfirst(str_replace(['-', '_'], ' ', __($name))) }}</label>

    <div class="flex flex-wrap space-x-4">
        {{-- Display newly uploaded files --}}
        @if ($modelValue)
            @if (is_array($modelValue))
                @foreach ($modelValue as $i => $m)
                    @php
                        $isImage =
                            is_object($m) && method_exists($m, 'getMimeType')
                                ? in_array($m->getMimeType(), ['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                                : false;
                    @endphp
                    <div class="w-1/4 mb-4">
                        <div class="relative p-2 border border-gray-300 rounded">
                            @if (is_string($m))
                                <img src="{{ asset($location . $m) }}" alt="Avatar"
                                    class="object-cover w-full h-24 rounded">
                            @elseif ($isImage)
                                <img src="{{ $m->temporaryUrl() }}" alt="Avatar"
                                    class="object-cover w-full h-24 rounded">
                            @else
                                <div class="flex items-center justify-center w-full h-24 bg-gray-100 rounded">
                                    <x-file-icon />
                                </div>
                            @endif
                            @if ($removeMethod)
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 bg-black bg-opacity-50 transition-opacity cursor-pointer"
                                    @click="$wire.{{ $removeMethod . '(' . $i . $removeParams . ')' }}">
                                    <div class="text-white">Remove</div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
                <div class="w-1/4 mb-4">
                    <div x-data="{}">
                        <button wire:loading.attr='disabled' @click="$refs.profilephoto.click()" type="button"
                            class="w-full py-2 px-4 bg-blue-500 text-white text-lg font-medium rounded hover:bg-blue-600">
                            <i class="fa fa-upload" aria-hidden="true"></i>
                        </button>
                        <input type="file" x-ref="profilephoto" {{ $disabled ? 'disabled' : '' }}
                            {!! $attributes->merge(['class' => $class, 'id' => $name]) !!}>
                        <div x-show="uploading" class="mt-2">
                            <div class="relative pt-1">
                                <div class="flex items-center justify-between">
                                    <div
                                        class="text-xs font-semibold inline-block py-1 px-2 rounded text-teal-600 bg-teal-200 mr-3">
                                        Upload Progress
                                    </div>
                                    <div
                                        class="text-xs font-semibold inline-block py-1 px-2 rounded text-teal-600 bg-teal-200">
                                        <span x-text="progress + '%'"></span>
                                    </div>
                                </div>
                                <div class="flex-1 bg-gray-200 rounded h-2 mt-1">
                                    <div class="bg-teal-500 h-full rounded" :style="'width: ' + progress + '%'"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @php
                    $isImage =
                        is_object($modelValue) && method_exists($modelValue, 'getMimeType')
                            ? in_array($modelValue->getMimeType(), [
                                'image/jpeg',
                                'image/png',
                                'image/gif',
                                'image/webp',
                            ])
                            : false;
                @endphp
                <div class="w-1/4 mb-4">
                    <div class="relative p-2 border border-gray-300 rounded">
                        @if (is_string($modelValue))
                            <img src="{{ asset($location . $modelValue) }}" alt="Avatar"
                                class="object-cover w-full h-24 rounded">
                        @elseif ($isImage)
                            <img src="{{ $modelValue->temporaryUrl() }}" alt="Avatar"
                                class="object-cover w-full h-24 rounded">
                        @else
                            <div class="flex items-center justify-center w-full h-24 bg-gray-100 rounded">
                                <x-file-icon />
                            </div>
                        @endif
                        @if ($removeMethod)
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 bg-black bg-opacity-50 transition-opacity cursor-pointer"
                                @click="$wire.{{ $removeMethod . '()' }}">
                                <div class="text-white">Remove</div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @else
            <div class="w-1/4 mb-4">
                <div x-data="{}">
                    <button wire:loading.attr='disabled' @click="$refs.profilephoto.click()" type="button"
                        class="w-full py-2 px-4 bg-blue-500 text-white text-lg font-medium rounded hover:bg-blue-600">
                        Upload
                    </button>
                    <input type="file" x-ref="profilephoto" {{ $disabled ? 'disabled' : '' }}
                        {!! $attributes->merge(['class' => $class, 'id' => $name]) !!}>

                    <div x-show="uploading" class="mt-2">
                        <div class="relative pt-1">
                            <div class="flex items-center justify-between">
                                <div
                                    class="text-xs font-semibold inline-block py-1 px-2 rounded text-teal-600 bg-teal-200">
                                    <span x-text="progress + '%'"></span>
                                </div>
                            </div>
                            <div class="flex-1 bg-gray-200 rounded h-2 mt-1">
                                <div class="bg-teal-500 h-full rounded" :style="'width: ' + progress + '%'"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @error($model)
            <div class="w-full mt-2 text-red-500 font-bold">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
