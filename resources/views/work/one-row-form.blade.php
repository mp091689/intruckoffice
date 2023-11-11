<form method="post" action="{{ route('works.store') }}"
      class="grid sm:grid-cols-5 grid-cols-1 justify-items-center items-center py-2 border-b border-gray-600 space-y-2 space-x-2">
    @csrf
    @method('post')
    <input type="hidden" name="load_id" value="{{ $load->id }}" required>
    <div class="w-full sm:pr-1 pr-2">
        <x-select name="driver_id" class="w-full" required>
            <option value="" selected disabled>{{ __('Driver') }}</option>
            @foreach($drivers as $driver)
                <option value="{{ $driver->id }}" {{ Request::get('driver_id') == $driver->id ? 'selected' : '' }}>{{ $driver->fullName() }}</option>
            @endforeach
        </x-select>
    </div>
    <div class="w-full sm:px-1 pr-2">
        <x-select name="type" class="w-full" required>
            <option value="" selected disabled>{{ __('Type') }}</option>
            @foreach(\App\Models\WorkType::cases() as $type)
                <option value="{{ $type->value }}" {{ Request::get('type') == $type->value ? 'selected' : '' }}>{{ ucfirst($type->value) }}</option>
            @endforeach
        </x-select>
    </div>
    <div class="relative w-full sm:px-1 pr-2">
        <x-text-input
                data-load-distance="{{ $load->actual_distance }}"
                name="duration"
                type="number"
                class="w-full"
                required
                placeholder="Duration"
                :value="$load->actual_distance" />
    </div>
    <div class="relative w-full sm:pl-1 pr-2">
        <x-text-input class="w-full" name="quota" type="number" required placeholder="Quota" :value="30" />
    </div>
    <x-primary-button>Add</x-primary-button>
</form>

@vite('resources/js/work.js')