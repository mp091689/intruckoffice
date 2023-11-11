<form method="post" action="{{ route('works.store') }}" class="grid grid-cols-5 justify-items-center items-center py-2 border-b border-gray-600">
    @csrf
    @method('post')
    <input type="hidden" name="load_id" value="{{ $load->id }}" required>
    <x-select name="driver_id" required>
        <option value="" selected disabled>{{ __('Driver') }}</option>
        @foreach($drivers as $driver)
            <option value="{{ $driver->id }}" {{ Request::get('driver_id') == $driver->id ? 'selected' : '' }}>{{ $driver->fullName() }}</option>
        @endforeach
    </x-select>
    <x-select name="type" required>
        <option value="" selected disabled>{{ __('Type') }}</option>
        @foreach(\App\Models\WorkType::cases() as $type)
            <option value="{{ $type->value }}" {{ Request::get('type') == $type->value ? 'selected' : '' }}>{{ ucfirst($type->value) }}</option>
        @endforeach
    </x-select>
    <div class="relative"><x-text-input data-load-distance="{{ $load->actual_distance }}" name="duration" type="number" required placeholder="Duration" :value="$load->actual_distance"/></div>
    <div class="relative"><x-text-input name="quota" type="number" required placeholder="Quota" :value="30"/></div>
    <x-primary-button>Add</x-primary-button>
</form>

@vite('resources/js/work.js')