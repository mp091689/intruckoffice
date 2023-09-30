<section>
    <form method="post" action="{{ route('loads.update', ['load' => $load]) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        @include('load.partials.form-fields')

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'updated')
                <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Load is updated.') }}</p>
            @endif
        </div>
    </form>
</section>
