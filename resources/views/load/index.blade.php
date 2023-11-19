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
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @foreach ($loads as $load)
                <div id="load-{{ $load->id }}"
                     class="load-card p-2 overflow-hidden shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-100 {{ $load->status->value }}"
                     :class="{ 'anchor': worksOpen }"
                     x-data="{
                        worksOpen: false,
                        init() {
                            this.worksOpen = window.location.hash === '#load-{{ $load->id }}'
                        },
                        get isWorksOpen() { return this.worksOpen }
                     }">
                    <div class="grid gap-2 sm:grid-cols-3 text-sm sm:text-md justify-items-center items-center">
                        <div class="text-center w-full">
                            <p>{{ $load->pickup_datetime->format('m/d/Y') }} -> {{ $load->dropoff_datetime->format('m/d/Y') }}</p>
                            <p>{{ $load->pickup_state }} ({{ $load->pickup_city }}) -> {{ $load->dropoff_state }} ({{ $load->dropoff_city }})</p>
                        </div>
                        <div class="text-center w-full">
                            <p class="underline font-bold">{{ $load->dispatcher?->name }}</p>
                            <p>${{ $load->actual_price }} / {{ $load->actual_distance }} mi
                                = {{ $load->pricePerMile() }} $pm</p>
                        </div>
                        <div class="grid sm:grid-cols-1 gap-2 text-center">
                            @if($load->invoices()->count())
                                <div>
                                    <p>Have invoices</p>
                                    <p>Can't be edited</p>
                                </div>
                            @else
                                <x-button-link
                                        :href="route('loads.edit', ['load' => $load])">{{  __('Edit') }}</x-button-link>
                            @endif
                            <x-primary-button type="button" @click="worksOpen = !worksOpen">
                                <div :class="{'rotate-180': !worksOpen,' -translate-y-0.0': worksOpen }">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </div>
                                {{  __('Works') }}
                            </x-primary-button>
                        </div>
                    </div>
                    <div x-show="isWorksOpen" class="pt-4 space-y-2" style="display: none;">
                        @include('work.partials.list')
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
