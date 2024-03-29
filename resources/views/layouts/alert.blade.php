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

@if (count($errors) > 0)
    <x-alert typeAlert='warning'>
        <strong>Errors:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alert>
@endif

