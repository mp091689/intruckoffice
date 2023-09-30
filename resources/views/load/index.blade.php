<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __($title) }}
            </h2>
            <x-button-link :href="route('loads.create')">{{  __('Add Load') }}</x-button-link>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach ($loads as $load)
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="text-gray-900 dark:text-gray-100">
                            <div class="grid gap-4 sm:grid-cols-3 text-sm sm:text-md justify-items-center items-center">
                                <div class="text-center w-full bg-gray-700 sm:bg-gray-800 py-2">
                                    <div class="pb-2 border-b border-gray-800 sm:border-gray-700">
                                        <h3 class="hidden sm:block underline text-center">FROM</h3>
                                        <p>{{ $load->pickup_address }}</p>
                                        <p>{{ $load->pickup_datetime }}</p>
                                    </div>
                                    <div class="mt-2">
                                        <h3 class="hidden sm:block underline text-center">TO</h3>
                                        <p>{{ $load->dropoff_address }}</p>
                                        <p>{{ $load->dropoff_datetime }}</p>
                                    </div>
                                </div>
                                <div class="text-center w-full bg-gray-700 sm:bg-gray-800 py-2">
                                    <p>{{ $load->distance }} miles</p>
                                    <p>$ {{ $load->price }}</p>
                                    <p>$ {{ number_format($load->price/$load->distance, 2) }} per mile</p>
                                </div>
                                <div class="grid {{ $load->driver2()->exists() ? 'grid-cols-2' : 'grid-cols-1' }} gap-4 w-full">
                                    <div class="text-center w-full bg-gray-700 sm:bg-gray-800 py-2">
                                        <p>{{ $load->driver->fullName() }}</p>
                                        <p>{{ $load->percentage }}%: $ {{ $load->getDriverSalary() }}</p>
                                        <p>$ {{ number_format($load->getDriverSalary()/$load->distance, 2) }} per mile</p>
                                    </div>
                                    @if($load->driver2()->exists())
                                        <div class="text-center w-full bg-gray-700 sm:bg-gray-800 py-2">
                                            <p>{{ $load->driver2->fullName() }}</p>
                                            <p>{{ $load->percentage2 }}%: $ {{ $load->getDriver2Salary() }}</p>
                                            <p>$ {{ number_format($load->getDriver2Salary()/$load->distance, 2) }} per mile</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex justify-end mt-4">
                                <x-button-link
                                        :href="route('loads.edit', ['load' => $load])">{{  __('Edit') }}</x-button-link>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
