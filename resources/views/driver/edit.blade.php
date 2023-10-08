<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Driver') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('driver.partials.form', ['route' => route('drivers.update', $driver), 'method' => 'patch'])
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('components.delete-form', [
    'title' => 'Delete Driver',
    'message' => 'Once driver is deleted, all of its resources and data will be permanently deleted.',
    'route' => route('drivers.destroy', $driver)])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
