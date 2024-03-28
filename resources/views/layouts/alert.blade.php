@if (session()->has('success'))
    <x-alert typeAlert='success'>
        {{ session('success') }}
    </x-alert>
@endif

@if (session()->has('warning'))
    <x-alert typeAlert='warning'>
        {{ session('warning') }}
    </x-alert>
@endif
