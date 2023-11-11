<section class="border border-gray-600">
    @foreach($load->works as $work)
        <div class="work grid grid-cols-5 justify-items-center items-center py-2 border-b border-gray-600 {{ $work->invoice ? 'bg-gray-700' : '' }}">
            <a class="text-lg underline"
               href="{{ route('drivers.show', ['driver' => $work->driver]) }}">{{ $work->driver->fullName() }}
                <span class="text-xs text-red-400">{{ $work->driver->uninvoicedWorks()->count() ? ' (' . $work->driver->uninvoicedWorks()->count() . ')' : '' }}</span></a>
            <div class="text-center items-center">{{ ucfirst($work->type->value) }}</div>
            <div class="text-center items-center">{{ $work->duration }} {{ $work->getDurationLabelName() }}</div>
            <div class="text-center items-center">
                @if($work->type === \App\Models\WorkType::DELIVERY)
                    {{ $work->quota }}% -
                @endif ${{ $work->getQuota() }}</div>
            @if($work->invoice)
                <span>{{ $work->invoice->number }}</span>
            @else
                @include('components.delete-form', [
'title' => '',
'message' => '',
'route' => route('works.destroy', $work)])
            @endif
        </div>
    @endforeach

    @include('work.one-row-form')
</section>
