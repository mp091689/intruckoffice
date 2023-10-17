<form method="post" action="{{ $route }}" class="mt-6 space-y-6">
    @csrf
    @method($method)

    <div>
        <x-input-label for="dispatcher_id" :value="__('Dispatcher')" />
        <x-select id="dispatcher_id" name="dispatcher_id" class="mt-1 block w-full" required autofocus>
            <option value="" selected disabled>Select Dispatcher</option>
            @foreach($dispatchers as $dispatcher)
                <option value="{{ $dispatcher->id }}" {{ old('dispatcher_id', $load->dispatcher?->id) == $dispatcher->id ? 'selected' : '' }}>{{  $dispatcher->name }}</option>
            @endforeach
        </x-select>
        <x-input-error class="mt-2" :messages="$errors->get('dispatcher_id')" />
    </div>

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
                      :value="old('pickup_datetime', $load->pickup_datetime ?? now()->startOfDay()->addHours(8))" />
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
                      :value="old('dropoff_datetime', $load->dropoff_datetime ?? now()->startOfDay()->addDay()->addHours(8))" />
        <x-input-error class="mt-2" :messages="$errors->get('dropoff_datetime')" />
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <x-input-label for="estimated_distance" :value="__('Estimated Distance')" />
            <x-text-input id="estimated_distance" name="estimated_distance" type="text" class="mt-1 block w-full"
                          required autofocus
                          :value="old('estimated_distance', $load->estimated_distance)" />
            <x-input-error class="mt-2" :messages="$errors->get('estimated_distance')" />
        </div>
        <div>
            <x-input-label for="actual_distance" :value="__('Actual Distance')" />
            <x-text-input id="actual_distance" name="actual_distance" type="text" class="mt-1 block w-full" required
                          autofocus
                          :value="old('actual_distance', $load->actual_distance)" />
            <x-input-error class="mt-2" :messages="$errors->get('actual_distance')" />
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <x-input-label for="estimated_price" :value="__('Estimated Price')" />
            <x-text-input id="estimated_price" name="estimated_price" type="text" class="mt-1 block w-full" required
                          autofocus
                          :value="old('estimated_price', $load->estimated_price)" />
            <x-input-error class="mt-2" :messages="$errors->get('estimated_price')" />
        </div>

        <div>
            <x-input-label for="actual_price" :value="__('Actual Price')" />
            <x-text-input id="actual_price" name="actual_price" type="text" class="mt-1 block w-full" required autofocus
                          :value="old('actual_price', $load->actual_price)" />
            <x-input-error class="mt-2" :messages="$errors->get('actual_price')" />
        </div>
    </div>

    <div>
        <x-input-label for="description" :value="__('Description')" />
        <x-text-area id="description" name="description" type="text" class="mt-1 block w-full" rows="8"
                     autofocus>{{ old('description', $load->description ?? '') }}</x-text-area>
        <x-input-error class="mt-2" :messages="$errors->get('description')" />
    </div>

    <div>
        <x-input-label for="status" :value="__('Status')" />
        <x-select id="status" name="status" class="mt-1 block w-full">
            @foreach(\App\Models\LoadStatus::values() as $status)
                <option value="{{ $status }}" {{ old('status', $load->status?->value) == $status ? 'selected' : '' }}>{{ Str::of($status)->snake()->replace('_', ' ')->title() }}</option>
            @endforeach
        </x-select>
        <x-input-error class="mt-2" :messages="$errors->get('status')" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Save') }}</x-primary-button>
    </div>

</form>