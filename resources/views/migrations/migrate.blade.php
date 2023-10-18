<section class="space-y-4">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Execute DB Migration') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once migration is executed, database will be changed and only new migration could revert changes. Before executing migration, please create database backups.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-db-migration')"
    >{{ __('Migrate') }}</x-danger-button>

    <x-modal name="confirm-db-migration" :show="$errors->migration->isNotEmpty()" focusable>
        <form method="post" action="{{ route('db.migrate') }}" class="p-4">
            @csrf
            @method('post')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to execute db migration?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once migration is executed, database will be changed and only new migration could revert changes. Before executing migration, please create database backups.') }}
            </p>

            <div class="mt-4 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Migrate') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
