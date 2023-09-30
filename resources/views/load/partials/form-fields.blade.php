<div>
    <x-input-label for="pickup_address" :value="__('Pickup Address')" />
    <x-text-input id="pickup_address" name="pickup_address" type="text" class="mt-1 block w-full" required
                  autofocus autocomplete="pickup_address"
                  :value="old('pickup_address', $load->pickup_address)" />
    <x-input-error class="mt-2" :messages="$errors->get('pickup_address')" />
</div>

<div>
    <x-input-label for="pickup_datetime" :value="__('Pickup Date Time')" />
    <x-text-input id="pickup_datetime" name="pickup_datetime" type="datetime-local" class="mt-1 block w-full"
                  required autofocus autocomplete="pickup_datetime"
                  :value="old('pickup_datetime', $load->pickup_datetime)" />
    <x-input-error class="mt-2" :messages="$errors->get('pickup_datetime')" />
</div>

<div>
    <x-input-label for="dropoff_address" :value="__('Drop Off Address')" />
    <x-text-input id="dropoff_address" name="dropoff_address" type="text" class="mt-1 block w-full" required
                  autofocus autocomplete="dropoff_address"
                  :value="old('dropoff_address', $load->dropoff_address)" />
    <x-input-error class="mt-2" :messages="$errors->get('dropoff_address')" />
</div>

<div>
    <x-input-label for="dropoff_datetime" :value="__('Drop Off Date Time')" />
    <x-text-input id="dropoff_datetime" name="dropoff_datetime" type="datetime-local" class="mt-1 block w-full"
                  required autofocus autocomplete="dropoff_datetime"
                  :value="old('dropoff_datetime', $load->dropoff_datetime)" />
    <x-input-error class="mt-2" :messages="$errors->get('dropoff_datetime')" />
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <x-input-label for="distance" :value="__('Distance')" />
        <x-text-input id="distance" name="distance" type="text" class="mt-1 block w-full" required autofocus
                      :value="old('distance', $load->distance)" />
        <x-input-error class="mt-2" :messages="$errors->get('distance')" />
    </div>

    <div>
        <x-input-label for="price" :value="__('Price')" />
        <x-text-input id="price" name="price" type="text" class="mt-1 block w-full" required autofocus
                      :value="old('price', $load->price)" />
        <x-input-error class="mt-2" :messages="$errors->get('price')" />
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <x-input-label for="driver_id" :value="__('Driver 1')" />
        <x-select id="driver_id" name="driver_id" class="mt-1 block w-full" required autofocus>
            <option value="" selected disabled>Select Driver 1</option>
            @foreach($drivers as $driver)
                <option value="{{ $driver->id }}" {{ old('driver_id', $load->driver?->id) == $driver->id ? 'selected' : '' }}>{{  $driver->first_name }} {{ $driver->last_name }}</option>
            @endforeach
        </x-select>
        <x-input-error class="mt-2" :messages="$errors->get('driver_id')" />
    </div>

    <div>
        <x-input-label for="percentage" :value="__('Percentage')" />
        <x-text-input id="percentage" name="percentage" type="text" class="mt-1 block w-full" required autofocus
                      :value="old('percentage', $load->percentage)" />
        <x-input-error class="mt-2" :messages="$errors->get('percentage')" />
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <x-input-label for="driver2_id" :value="__('Driver 2')" />
        <x-select id="driver2_id" name="driver2_id" class="mt-1 block w-full">
            <option value="" selected >Select Driver 2</option>
            @foreach($drivers as $driver)
                <option value="{{ $driver->id }}" {{ old('driver2_id', $load->driver2?->id) == $driver->id ? 'selected' : '' }}>{{  $driver->first_name }} {{ $driver->last_name }}</option>
            @endforeach
        </x-select>
        <x-input-error class="mt-2" :messages="$errors->get('driver2_id')" />
    </div>

    <div>
        <x-input-label for="percentage2" :value="__('Percentage 2')" />
        <x-text-input id="percentage2" name="percentage2" type="text" class="mt-1 block w-full" required
                      autofocus
                      :value="old('percentage2', $load->percentage2)" />
        <x-input-error class="mt-2" :messages="$errors->get('percentage2')" />
    </div>
</div>

<div>
    <x-input-label for="description" :value="__('Description')" />
    <x-text-area id="description" name="description" type="text" class="mt-1 block w-full" rows="4"
                 autofocus>{{ old('description', $load->description) }}</x-text-area>
    <x-input-error class="mt-2" :messages="$errors->get('description')" />
</div>
