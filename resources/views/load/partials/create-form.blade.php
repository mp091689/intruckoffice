<section>
    <form method="post" action="{{ route('loads.store') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')
        @include('load.partials.form-fields')

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
