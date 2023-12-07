<div class="border border-gray-600 rounded p-2 space-y-2 text-center"
     x-id="['zip-item']"
     x-data="{ zipItems: {!! str_replace('"', "'", json_encode(old('zipCodes', $load->getFrontZipItems()))) !!}, addZipItem() { this.zipItems.push({id:this.zipItems.length}) } }">
    <template x-for="(zipItem, idx) in Object.values(zipItems)" :key="idx">
        <div :id="$id('zipItem')" class="grid grid-cols-4 gap-4">
            <div class="my-auto">
                <x-select x-bind:name="`zipCodes[${idx}][type]`"
                          x-model="zipItem.type"
                          class="mt-1 block w-full">
                    @foreach(\App\Enums\ZipCodeType::values() as $type)
                        <option value="{{ $type }}">{{ Str::title($type) }}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="my-auto">
                <x-text-input x-bind:name="`zipCodes[${idx}][zip]`"
                              x-model="zipItem.zip"
                              type="text"
                              class="mt-1 block w-full"
                              required
                />
                <x-input-error class="mt-2" :messages="$errors->get('zip_code')" />
            </div>
            <div class="my-auto">
                <x-text-input x-bind:name="`zipCodes[${idx}][datetime]`"
                              x-model="zipItem.datetime"
                              type="datetime-local"
                              class="mt-1 block w-full"
                              required
                />
                <x-input-error class="mt-2" :messages="$errors->get('zip_datetime')" />
            </div>
            <div class="m-auto">
                <x-danger-button class="delete-zip-item"
                                 @click.prevent="console.log($event.target.parentElement.parentElement.remove())">
                    {{ __('Delete') }}
                </x-danger-button>
            </div>
        </div>
    </template>
    <div>
        <x-primary-button type="button" @click="addZipItem()">{{ __('Add Address') }}</x-primary-button>
    </div>
</div>
