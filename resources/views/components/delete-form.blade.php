<section class="space-y-4">
    @if($title || $message)
        <header>
            @if($title)
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __($title) }}
                </h2>
            @endif

            @if($message)
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __($message) }}
                </p>
            @endif
        </header>
    @endif

    <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-deletion-{{md5($route)}}')"
    >{{ __('Delete') }}</x-danger-button>

    <x-modal name="confirm-deletion-{{md5($route)}}" :show="$errors->deletion->isNotEmpty()" focusable>
        <form method="post" action="{{ $route }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete entity?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __($message) }}
            </p>

            <div class="mt-4 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
