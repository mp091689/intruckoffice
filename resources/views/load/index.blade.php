<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Loads') }}
            </h2>
            <div class="space-x-2 text-end">
{{--                <x-button-link :href="route('invoices.generate')">{{  __('Invoices') }}</x-button-link>--}}
                <x-button-link :href="route('loads.create')">{{  __('Add Load') }}</x-button-link>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach ($loads as $load)
                <div class="load-card p-2 sm:p-2 bg-teal-50 dark:bg-teal-950 overflow-hidden shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-100 {{ $load->status }}">
                    <div class="grid gap-2 sm:grid-cols-4 text-sm sm:text-md justify-items-center items-center">
                        <div class="text-center w-full">
                            <p>{{ $load->pickup_address }} {{ $load->pickup_datetime->format('m/d/y H:i') }} -></p>
                            <p>-> {{ $load->dropoff_address }} {{ $load->dropoff_datetime->format('m/d/y H:i') }}</p>
                        </div>
                        <div class="text-center w-full">
                            <p class="underline font-bold">{{ $load->dispatcher?->name }}</p>
                            <p>{{ $load->distance }} miles / $ {{ $load->price }}</p>
                            <p>$ {{ number_format($load->price/$load->distance, 2) }} per mile</p>
                        </div>
                        <div class="grid {{ $load->driver2()->exists() ? 'grid-cols-2' : 'grid-cols-1' }} gap-4 w-full">
                            <div class="text-center w-full">
                                <p>{{ $load->driver->fullName() }}</p>
                                <p>{{ $load->percentage }}%: $ {{ $load->getDriverSalary() }}</p>
                            </div>
                            @if($load->driver2()->exists())
                                <div class="text-center w-full">
                                    <p>{{ $load->driver2->fullName() }}</p>
                                    <p>{{ $load->percentage2 }}%: $ {{ $load->getDriver2Salary() }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="grid sm:grid-cols-1 gap-2 {{ $load->status === 'in_progress' ? 'grid-cols-3' : 'grid-cols-1' }}">
                            <x-button-link
                                    :href="route('loads.edit', ['load' => $load])">{{  __('Edit') }}</x-button-link>
                            @if($load->status === 'in_progress')
                                @include('load.partials.cancel-form')
                                @include('load.partials.done-form')
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
