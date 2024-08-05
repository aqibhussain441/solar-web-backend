<div class="flex" x-data="inputRateComponent()" x-modelable="rate" {{ $attributes }}>
    <button @click="decrement" class="rounded-s-lg flex items-center border border-primary border-e-0 p-4">
        -
    </button>
    <div class="flex-1 relative">
        <input id="{{ $id }}" x-model="rate" @input="validateRate"
            class="input input-primary w-full peer rounded-s-none rounded-e-none border-x-0 h-14 pt-3" type="text" />
        <label for="{{ $id }}"
            class="absolute text-gray-400 duration-300 transform -translate-y-1 scale-75 top-2 origin-left rtl:origin-right rounded px-0 peer-focus:px-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-1 start-3">
            {{ $label }}
        </label>
    </div>
    <button @click="increment" class="rounded-e-lg flex items-center border border-primary border-s-0 p-4">
        +
    </button>
</div>

<script type="text/javascript">
    function inputRateComponent() {
        return {
            rate: '0,0',
            init() {
                console.log(this.rate);
                this.rate = this.rate.toString().replace('.', ',');
                console.log(this.rate);
            },
            increment() {
                let currentRate = parseFloat(this.rate.toString().replace(',', '.'));
                if (currentRate < 4.0) {
                    currentRate += 0.1;
                } else {
                    currentRate += 0.5;
                }
                this.rate = currentRate.toFixed(1).replace('.', ',');
                this.validateRate();
            },
            decrement() {
                let currentRate = parseFloat(this.rate.toString().replace(',', '.'));
                if (currentRate > 4.0) {
                    currentRate -= 0.5;
                } else {
                    currentRate -= 0.1;
                }
                this.rate = currentRate.toFixed(1).replace('.', ',');
                this.validateRate();
            },
            validateRate() {
                let currentRate = parseFloat(this.rate.toString().replace(',', '.'));
                if (currentRate < 0) {
                    this.rate = '0,0';
                } else if (currentRate > 20) {
                    this.rate = '20,0';
                } else {
                    this.rate = currentRate.toFixed(1).replace('.', ',');
                }
            }
        }
    }
</script>
