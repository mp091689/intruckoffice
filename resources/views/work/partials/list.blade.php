<section class="border border-sky-700">
    @foreach($load->works as $work)
        <div class="work grid sm:grid-cols-5 grid-cols-1 justify-items-center items-center py-2 border-b border-sky-700">
            <a class="text-lg underline"
               href="{{ route('drivers.show', ['driver' => $work->driver]) }}">{{ $work->driver->fullName() }}
                <span class="text-xs text-red-400">{{ $work->driver->uninvoicedWorks()->count() ? ' (' . $work->driver->uninvoicedWorks()->count() . ')' : '' }}</span></a>
            <div class="text-center items-center">{{ ucfirst($work->type->value) }}</div>
            <div class="text-center items-center">{{ $work->duration }} {{ $work->getDurationLabelName() }}</div>
            <div class="text-center items-center">
                @if($work->type === \App\Enums\WorkType::DELIVERY)
                    {{ $work->quota }}% -
                @endif ${{ $work->getQuota() }}</div>
            @if($work->invoice)
                <a class="text-lg underline"
                   href="{{ route('invoices.index', ['number' => $work->invoice->number]) }}"
                >
                    {{ $work->invoice->number }}
                </a>
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
