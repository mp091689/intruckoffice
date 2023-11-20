<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Driver') . ': ' . $driver->fullName() }}</h2>
    </x-slot>

    <div class="py-4 text-gray-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg space-y-2">
                <p>Full Name: <span class="font-bold text-lg">{{ $driver->fullName() }}</span></p>
                <p>Phone: <a class="font-bold text-lg underline"
                             href="tel:{{ $driver->phone }}">{{ $driver->phone }}</a></p>
                <p>Email: <a class="font-bold text-lg underline" href="mailto:{{ $driver->email }}"
                             target="_blank">{{ $driver->email }}</a></p>
                <p class="text-lg text-red-400 flex items-center">
                    @if($driver->uninvoicedWorks()->count())
                        <x-button-link class="mr-4" :href="route('drivers.invoices.create', [$driver])">Generate invoice</x-button-link>
                        {{ $driver->uninvoicedWorks()->count() }} univoiced works
                    @endif
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
