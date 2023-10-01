<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Add Dispatcher') }}
        </h2>
    </header>

    <form method="post" action="{{ route('dispatchers.store') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')
        @include('dispatcher.partials.form-fields')

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'created')
                <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Dispatcher is created.') }}</p>
            @endif
        </div>
    </form>
</section>
