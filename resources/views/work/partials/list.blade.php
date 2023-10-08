<section class="border border-gray-600">
    @foreach($load->works as $work)
        <div class="work grid grid-cols-3 justify-items-center items-center py-2 border-b border-gray-600">
            <div class=text-center">{{ $work->driver->fullName() }}</div>
            <div>{{ $work->percent }}% - $ {{ $work->price() }}</div>
            <x-button-link :href="route('works.edit', ['work' => $work])">{{ __('edit') }}</x-button-link>
        </div>
    @endforeach
    <div class="flex justify-center m-2">
        <x-button-link :href="route('works.create', ['load' => $load->id])">{{ __('Add work') }}</x-button-link>
    </div>
</section>
