<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl align-middle text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Load') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form method="post" action="{{ route('works.update', ['work' => $work]) }}" class="mt-4 space-y-4">
                    @csrf
                    @method('patch')
                    @include('work.partials.form-fields')
                </form>
            </div>

            <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @include('components.delete-form', [
'title' => 'Delete Work',
'message' => 'Once work is deleted, all of its resources and data will be permanently deleted.',
'route' => route('works.destroy', $work)])
            </div>
        </div>
    </div>
</x-app-layout>
