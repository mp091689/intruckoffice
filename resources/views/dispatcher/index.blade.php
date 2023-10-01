<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dispatchers') }}
            </h2>
            <x-button-link :href="route('dispatchers.create')">{{  __('Add Dispatcher') }}</x-button-link>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach ($dispatchers as $dispatcher)
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg  overflow-hidden text-gray-900 dark:text-gray-100">
                    <div class="grid gap-4 sm:grid-cols-4 text-sm sm:text-md justify-items-center items-center">
                        <p>{{ $dispatcher->name }}</p>
                        <x-button-link
                                :href="route('dispatchers.edit', ['dispatcher' => $dispatcher])">{{  __('Edit') }}</x-button-link>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
