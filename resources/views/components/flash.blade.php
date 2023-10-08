@if (session('flash'))
        <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-transition:leave.duration.1000ms
                x-init="setTimeout(() => show = false, 3000)"
                class="flash-message text-white dark:text-white fixed w-full z-10 p-4 bottom-0 {{ session('flash')['status'] }}"
        >{{ __(session('flash')['text']) }}</p>
@endif

@if ($errors->count())
        <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-transition:leave.duration.1000ms
                x-init="setTimeout(() => show = false, 3000)"
                class="flash-message text-white dark:text-white fixed w-full z-10 p-4 bottom-0 fail"
        >{{ __('Check validation errors.') }}</p>
@endif