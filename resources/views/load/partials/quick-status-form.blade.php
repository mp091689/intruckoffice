<form action="{{ route('load.quick-status-change', [$load]) }}" method="post">
    @csrf
    @method('post')
    <x-select
            id="status"
            name="status"
            x-on:change.prevent="$event.target.form.submit();"
    >
        @foreach(\App\Enums\LoadStatus::values() as $status)
            <option value="{{ $status }}" {{ old('status', $load->status?->value) == $status ? 'selected' : '' }}>{{ Str::of($status)->snake()->replace('_', ' ')->title() }}</option>
        @endforeach
    </x-select>
</form>