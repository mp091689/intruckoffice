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
                            @foreach($load->zipCodes as $zipCode)
                                <p>
                                    {{ Str::title($zipCode->pivot->type->value) }}
                                    {{ $zipCode->pivot->datetime->format('m/d') }}
                                    {{ $zipCode->state }}
                                </p>
                            @endforeach
                        </div>
                        <div class="text-center w-full">
                            <p>{{ $load->dispatcher?->name }}</p>
                            <p>${{ $load->actual_price }} / {{ $load->actual_distance }} mi
                                = {{ $load->pricePerMile() }} $pm</p>
                        </div>
                        <div class="text-center">
                            @if($load->invoices()->count())
                                <div>
                                    <p>Have invoices</p>
                                    <p>Can't be edited</p>
                                </div>
                            @else
                                <div class="flex gap-2">
                                    <x-button-link :href="route('loads.edit', [$load])">
                                        {{  __('Edit') }}
                                    </x-button-link>
                                    @include('load.partials.quick-status-form', ['loadId' => $load->id])
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="mt-2" @click="worksOpen = !worksOpen"
                         :class="{'rotate-180': worksOpen,' -translate-y-0.0': !worksOpen }">
                        <div class="border-t border-sky-700 w-1/2 mx-auto"></div>
                        <div class="border-t border-sky-700 mt-0.5 w-1/3 mx-auto"></div>
                        <div class="border-t border-sky-700 mt-0.5 w-1/5 mx-auto"></div>
                        <div class="border-t border-sky-700 mt-0.5 w-1/12 mx-auto"></div>
                    </div>
                    <div x-show="isWorksOpen" class="-mt-3.5 pt-4 space-y-2" style="display: none;">
                        @include('work.partials.list')
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
