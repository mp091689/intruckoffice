<form method="post" action="{{ route('loads.update.status', ['load' => $load]) }}">
    @csrf
    @method('patch')
    <x-text-input id="status" name="status" type="text" class="hidden" required
                  :value="\App\Models\Load::STATUS_DONE" />
    <x-primary-button class="bg-green-800 dark:bg-green-400 w-full">{{ __('Done') }}</x-primary-button>
</form>
