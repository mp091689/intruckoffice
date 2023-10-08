<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Loads') }}
            </h2>
            <div class="space-x-2 text-end">
                <x-button-link :href="route('loads.create')">{{  __('Add Load') }}</x-button-link>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach ($loads as $load)
                <div class="load-card p-2 overflow-hidden shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-100 {{ $load->status->value }}"
                     x-data="{ executionOpen: false }">
                    <div class="grid gap-2 sm:grid-cols-3 text-sm sm:text-md justify-items-center items-center">
                        <div class="text-center w-full">
                            <p>{{ $load->pickup_address }} {{ $load->pickup_datetime->format('m/d/y H:i') }} -></p>
                            <p>-> {{ $load->dropoff_address }} {{ $load->dropoff_datetime->format('m/d/y H:i') }}</p>
                        </div>
                        <div class="text-center w-full">
                            <p class="underline font-bold">{{ $load->dispatcher?->name }}</p>
                            <p>$ {{ $load->actual_price }} / {{ $load->actual_distance }} mi
                                = {{ $load->pricePerMile() }} $pm</p>
                        </div>
                        <div class="grid sm:grid-cols-1 gap-2">
                            <x-button-link
                                    :href="route('loads.edit', ['load' => $load])">{{  __('Edit') }}</x-button-link>
                            <x-primary-button type="button" @click="executionOpen = !executionOpen">
                                <div :class="{'rotate-180': !executionOpen,' -translate-y-0.0': executionOpen }">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </div>
                                {{  __('Execution') }}
                            </x-primary-button>
                        </div>
                    </div>
                    <div x-show="executionOpen" class="pt-4 space-y-2">
                        @include('work.partials.list')
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
