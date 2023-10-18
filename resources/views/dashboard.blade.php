<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <p class="text-gray-900 dark:text-gray-100 text-lg">{{ __("Loads by Dispatchers") }}</p>
                <p class="text-gray-900 dark:text-gray-400 text-sm">{{ __("Step one month") }}</p>
                <div id="chart_div" class="w-full h-96"></div>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                    const dispatchers = {!! $dispatchers->toJson() !!};
                    const groupedLoads = {!! $groupedLoads->toJson() !!};
                </script>
                @vite('resources/js/charts.js')
            </div>

            @role('admin')

            @if($logs)
                <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <x-text-area class="w-full" rows="10">{{ $logs }}</x-text-area>
                </div>
            @endif

            <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @include('migrations.migrate')
            </div>
            @endrole
        </div>

    </div>

</x-app-layout>
