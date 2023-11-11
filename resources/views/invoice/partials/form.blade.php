<form id="invoice-form" method="post" action="{{ $route }}" class="mt-4">
    @csrf
    @method($method)

    <div class="works-group" x-data="{ worksOpen: false }">
        <div class="w-full flex justify-end mb-4">
            <x-primary-button type="button" @click="worksOpen = !worksOpen">
                <div :class="{'rotate-180': !worksOpen,' -translate-y-0.0': worksOpen }">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
                {{  __('Customize Invoice') }}
            </x-primary-button>
        </div>
        <div x-show="worksOpen" class="p-4 space-y-2 bg-gray-700" style="display: none;">
            @foreach($works as $work)
                <div>
                                    <x-input-label class="inline-block">
                                        <x-text-input :id="'work-id-' . $work->id"
                                                      type="checkbox"
                                                      class="mr-2"
                                                      name="work_ids[]"
                                                      :data-title="$work->getInvoiceTitle()"
                                                      :data-price="$work->getQuota()"
                                                      :value="$work->id"
                                                      checked />
                                        {{ $work->getInvoiceTitle() }} - <span
                                class="text-green-200">${{ $work->getQuota() }}</span>
                    </x-input-label>
                </div>
            @endforeach
            <div id="custom-works" class="space-y-2">
                <div>
                    <x-input-label for="custom_work" :value="__('Custom work')" />
                    <x-text-area id="custom_work" name="custom_work" type="text" class="mt-1 block w-full" rows="2"
                    >{{ old('custom_work') }}</x-text-area>
                    <x-input-error class="mt-2" :messages="$errors->get('custom_work')" />
                </div>
                <div>
                    <x-input-label for="custom_total" :value="__('Custom total $')" />
                    <x-text-input id="custom_total" name="custom_total" type="number" class="mt-1 block w-full"
                                  :value="old('custom_total', 0)" />
                    <x-input-error class="mt-2" :messages="$errors->get('custom_total')" />
                </div>
            </div>
        </div>
    </div>

    <div>
        <textarea readonly
                  class="hidden"
                  id="generated_log"
                  name="generated_log"
                  data-header="{{ $invoiceHeader }}"
        >{{ old('generated_log', $invoice->generated_log) }}</textarea>
        <pre id="pre_generated_log" class="mt-4 p-4 bg-gray-700 text-gray-300 whitespace-pre-wrap"></pre>
        <x-input-error class="mt-2" :messages="$errors->get('generated_log')" />
    </div>

    <input class="hidden" name="total" id="total" value="{{ old('total', $invoice->total ?? 0) }}">
    <input class="hidden" name="number" id="number" value="{{ old('number', $invoice->number) }}">

    <div class="flex justify-end mt-4">
        <x-primary-button>{{ __('Post') }}</x-primary-button>
    </div>
</form>

@vite('resources/js/invoice.js')
