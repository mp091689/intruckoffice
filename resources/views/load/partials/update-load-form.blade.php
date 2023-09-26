<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Edit Load') }}
        </h2>
    </header>

    <form method="post" action="{{ route('load.update', ['load' => $load]) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="pickup_address" :value="__('Pickup Address')" />
            <x-text-input id="pickup_address" name="pickup_address" type="text" class="mt-1 block w-full" required autofocus autocomplete="pickup_address" :value="old('pickup_address', $load->pickup_address)"/>
            <x-input-error class="mt-2" :messages="$errors->get('pickup_address')" />
        </div>
        <div>
            <x-input-label for="pickup_datetime" :value="__('Pickup Date Time')" />
            <x-text-input id="pickup_datetime" name="pickup_datetime" type="datetime-local" class="mt-1 block w-full" required autofocus autocomplete="pickup_datetime" :value="old('pickup_datetime', $load->pickup_datetime)"/>
            <x-input-error class="mt-2" :messages="$errors->get('pickup_datetime')" />
        </div>

        <div>
            <x-input-label for="dropoff_address" :value="__('Drop Off Address')" />
            <x-text-input id="dropoff_address" name="dropoff_address" type="text" class="mt-1 block w-full" required autofocus autocomplete="dropoff_address" :value="old('dropoff_address', $load->dropoff_address)"/>
            <x-input-error class="mt-2" :messages="$errors->get('dropoff_address')" />
        </div>
        <div>
            <x-input-label for="dropoff_datetime" :value="__('Pickup Date Time')" />
            <x-text-input id="dropoff_datetime" name="dropoff_datetime" type="datetime-local" class="mt-1 block w-full" required autofocus autocomplete="dropoff_datetime" :value="old('dropoff_datetime', $load->dropoff_datetime)"/>
            <x-input-error class="mt-2" :messages="$errors->get('dropoff_datetime')" />
        </div>

        <div>
            <x-input-label for="distance" :value="__('Distance')" />
            <x-text-input id="distance" name="distance" type="text" class="mt-1 block w-full" required autofocus :value="old('distance', $load->distance)"/>
            <x-input-error class="mt-2" :messages="$errors->get('distance')" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="price" :value="__('Price')" />
                <x-text-input id="price" name="price" type="text" class="mt-1 block w-full" required autofocus :value="old('price', $load->price)"/>
                <x-input-error class="mt-2" :messages="$errors->get('price')" />
            </div>

            <div>
                <x-input-label for="percentage" :value="__('Percentage')" />
                <x-text-input id="percentage" name="percentage" type="text" class="mt-1 block w-full" required autofocus :value="old('percentage', $load->percentage)" />
                <x-input-error class="mt-2" :messages="$errors->get('percentage')" />
            </div>
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-area id="description" name="description" type="text" class="mt-1 block w-full" rows="4" required autofocus>{{ old('description', $load->description) }}</x-text-area>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('success') === 'Load Updated')
                <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Load is updated.') }}</p>
            @endif
        </div>
    </form>
</section>
