<!-- resources/views/components/searchable-multi-select.blade.php -->
<div x-data="{
    options: {{ json_encode($options) }},
    selectedKeys: [],
    search: '',
    isOpen: false,
    name: '{{ $name }}',

    get filteredOptions() {
        return Object.fromEntries(
            Object.entries(this.options).filter(([key, value]) =>
                value.toLowerCase().includes(this.search.toLowerCase())
            )
        );
    },

    toggleDropdown() {
        this.isOpen = !this.isOpen;
    },

    closeDropdown() {
        this.isOpen = false;
    },

    selectOption(key) {
        if (!this.selectedKeys.includes(key)) {
            this.selectedKeys.push(key);
        }
        this.closeDropdown();
    },

    removeOption(key) {
        this.selectedKeys = this.selectedKeys.filter(k => k !== key);
    },
}" x-modelable="selectedKeys" {{ $attributes }}>
    <div class="relative">
        <input type="text" placeholder="Search..." x-model="search" class="w-full border rounded p-2"
            @click="toggleDropdown" @keydown.escape="closeDropdown" />
        <div class="absolute mt-1 w-full bg-white border rounded shadow-md z-10" x-show="isOpen" style="display: none;">
            <ul>
                <template x-for="(value, key) in filteredOptions" :key="key">
                    <li class="p-2 cursor-pointer hover:bg-gray-100"
                        :class="{ 'bg-gray-100': selectedKeys.includes(key) }" @click="selectOption(key)">
                        <span x-text="value"></span>
                    </li>
                </template>
            </ul>
        </div>
    </div>

    <div class="mt-2">
        <template x-for="key in selectedKeys" :key="key">
            <span class="inline-block bg-blue-200 text-blue-700 p-1 rounded m-1">
                <span x-text="options[key]"></span>
                <button type="button" class="ml-1 text-red-500" @click="removeOption(key)">&times;</button>
            </span>
        </template>
    </div>

    <input type="hidden" :name="name" :value="selectedKeys">
</div>
