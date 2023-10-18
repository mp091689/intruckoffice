<form method="post" action="{{ $route }}" class="mt-4 space-y-4">
    @csrf
    @method($method)

    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name"
                      :value="old('name', $dispatcher->name)" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Save') }}</x-primary-button>
    </div>

</form>