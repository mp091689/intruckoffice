<form method="post" action="{{ route('loads.update.status', ['load' => $load]) }}">
    @csrf
    @method('patch')
    <x-text-input id="status" name="status" type="text" class="hidden" required
                  :value="\App\Models\Load::STATUS_CANCELED" />
    <x-primary-button class="bg-green-800 dark:bg-red-400">{{ __('Cancel') }}</x-primary-button>
</form>
