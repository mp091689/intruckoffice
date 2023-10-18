<section class="border border-gray-600">
    @foreach($load->works as $work)
        <div class="work grid grid-cols-3 justify-items-center items-center py-2 border-b border-gray-600 {{ $work->invoice ? 'bg-gray-700' : '' }}">
            <a class="text-lg underline"
               href="{{ route('drivers.show', ['driver' => $work->driver]) }}">{{ $work->driver->fullName() }} <span class="text-xs text-red-400">{{ $work->driver->uninvoicedWorks()->count() ? ' (' . $work->driver->uninvoicedWorks()->count() . ')' : '' }}</span></a>
            <div class="text-center grid grid-cols-1 items-center sm:grid-cols-2">
                <div>{{ $work->percent }}% - $ {{ $work->price() }}</div>
            </div>
            @if($work->invoice)
                <span >{{ $work->invoice->number }}</span>
            @else
                <x-button-link :href="route('works.edit', ['work' => $work])">{{ __('edit') }}</x-button-link>
            @endif
        </div>
    @endforeach
    <div class="flex justify-center m-2">
        <x-button-link :href="route('works.create', ['load' => $load->id])">{{ __('Add work') }}</x-button-link>
    </div>
</section>
