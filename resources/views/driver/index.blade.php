<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Drivers') }}
            </h2>
            <x-button-link :href="route('drivers.create')">{{  __('Add Driver') }}</x-button-link>
        </div>
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @foreach ($drivers as $driver)
                <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg  overflow-hidden text-gray-900 dark:text-gray-100">
                    <div class="grid gap-4 sm:grid-cols-4 text-sm sm:text-md justify-items-center items-center">
                        <a class="text-lg underline"
                           href="{{ route('drivers.show', ['driver' => $driver]) }}">{{ $driver->fullName(true) }} <span class="text-xs text-red-400">{{ $driver->uninvoicedWorks()->count() ? ' (' . $driver->uninvoicedWorks()->count() . ')' : '' }}</span></a>
                        <a class="text-lg underline" href="tel:{{ $driver->phone }}">{{ $driver->phone }}</a>
                        <a class="text-lg underline" href="mailto:{{ $driver->email }}"
                           target="_blank">{{ $driver->email }}</a>
                        <div class="grid sm:grid-cols-1 gap-2">
                            <x-button-link
                                    :href="route('drivers.show', ['driver' => $driver])">{{  __('View') }}</x-button-link>
                            <x-button-link
                                    :href="route('drivers.edit', ['driver' => $driver])">{{  __('Edit') }}</x-button-link>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
