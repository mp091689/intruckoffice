<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Driver') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @include('driver.partials.form', ['route' => route('drivers.store'), 'method' => 'post'])
            </div>
        </div>
    </div>
</x-app-layout>
