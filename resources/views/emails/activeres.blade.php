
@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    Your Registration and Activation has done successfully
    <br>
    Please Login to your account using the following credentials
    @component('mail::table')
        | Username      | Password      |
        |:-------------:|:-------------:|
        | Your Email    | {{$restaurant->pne}}      |
    @endcomponent

    Thanks,
    {{ config('app.name') }}


    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
