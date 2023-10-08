<div class="text-gray-400">
    <x-input-label for="load_id" :value="__('Load')" />
    <input type="hidden" name="load_id" value="{{ $work->theLoad->id }}">
    <div class="grid grid-cols-1 sm:grid-cols-2">
        <div>
            <p>
                <span class="font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('FROM') }}:</span> {{ $work->theLoad->pickup_address }} {{ $work->theLoad->pickup_datetime->format('m/d/y H:i') }}
            </p>
            <p>
                <span class="font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('TO') }}:</span> {{ $work->theLoad->dropoff_address }} {{ $work->theLoad->dropoff_datetime->format('m/d/y H:i') }}
            </p>
        </div>
        <div>
            <p><span class="font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('PRICE') }}:</span>
                $ {{ $work->theLoad->actual_price }} </p>
            <p>
                <span class="font-medium text-sm text-gray-700 dark:text-gray-300">{{ __('DISTANCE') }}:</span> {{ $work->theLoad->actual_distance }} {{ __('miles') }}
            </p>
        </div>
    </div>
</div>

<div>
    <x-input-label for="driver_id" :value="__('Driver')" />
    <x-select id="driver_id" name="driver_id" class="mt-1 block w-full" required autofocus>
        <option value="" selected disabled>Select Driver</option>
        @foreach($drivers as $driver)
            <option value="{{ $driver->id }}" {{ old('driver_id', $work->driver?->id) == $driver->id ? 'selected' : '' }}>{{  $driver->fullName() }}</option>
        @endforeach
    </x-select>
    <x-input-error class="mt-2" :messages="$errors->get('driver_id')" />
</div>

<div>
    <x-input-label for="distance" :value="__('Distance')" />
    <x-text-input id="distance" name="distance" type="text" class="mt-1 block w-full" required autofocus
                  :value="old('distance', $work->distance ?? $work->theLoad->actual_distance)" />
    <x-input-error class="mt-2" :messages="$errors->get('distance')" />
</div>

<div>
    <x-input-label for="percent" :value="__('Percent')" />
    <x-text-input id="percent" name="percent" type="text" class="mt-1 block w-full" required
                  autofocus autocomplete="percent"
                  :value="old('percent', $work->percent ?? 30)" />
    <x-input-error class="mt-2" :messages="$errors->get('percent')" />
</div>

<div>
    <x-input-label for="description" :value="__('Description')" />
    <x-text-area id="description" name="description" type="text" class="mt-1 block w-full" rows="8"
                 autofocus>{{ old('description', $work->description ?? '') }}</x-text-area>
    <x-input-error class="mt-2" :messages="$errors->get('description')" />
</div>

<input type="hidden" name="status" value="{{ \App\Models\WorkStatus::IN_PROGRESS->value }}">

<div class="flex items-center gap-4">
    <x-primary-button>{{ __('Save') }}</x-primary-button>
</div>