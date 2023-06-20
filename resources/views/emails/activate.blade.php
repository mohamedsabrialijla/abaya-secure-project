
@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

  <h3>الكود الخاص للدخول إلى تطبيق عباية سكوير هو : </h3>
    <br>
    @component('mail::table')
        | {{$code}}     |
        |:-------------:|
    @endcomponent

    شكراً,
    {{ config('app.name') }}


    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')

               ." جميع الحقوق محفوظة لدى تطبيق{{ " " .config('app.name') }}  © {{ date('Y') }}  "
        @endcomponent
    @endslot
@endcomponent
