<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Generate Invoice') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="font-semibold text-md text-gray-800 dark:text-gray-200 leading-tight">{{ __('Driver') }}
                    : {{ $driver->fullName() }}</h3>
                @include('invoice.partials.form', ['route' => route('invoices.store'), 'method' => 'post'])
            </div>
        </div>
    </div>
</x-app-layout>
