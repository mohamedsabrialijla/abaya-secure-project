{{--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 8
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
 --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ Metronic::printAttrs('html') }}
    {{ Metronic::printClasses('html') }}
    {!!  config('layout.self.rtl') ? ' direction="rtl" dir="rtl" style="direction: rtl" ' : ''  !!}>
    <head>
        <meta charset="utf-8"/>

        {{-- Title Section --}}
        <title>{{ config('app.name') }} | @yield('title', $page_title ?? '')</title>
        {{-- Meta Data --}}
        <meta name="description" content="@yield('page_description', $page_description ?? '')"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        {{-- Favicon --}}
        <link rel="shortcut icon" href="{{asset('favicon/favicon-32x32.png')}}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- Fonts --}}
        {{ Metronic::getGoogleFontsInclude() }}

        {{-- Global Theme Styles (used by all pages) --}}
        @foreach(config('layout.resources.css') as $style)
            <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($style)) : asset($style) }}" rel="stylesheet" type="text/css"/>
        @endforeach

        {{-- Layout Themes (used by all pages) --}}
        @foreach (Metronic::initThemes() as $theme)
            <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($theme)) : asset($theme) }}" rel="stylesheet" type="text/css"/>
        @endforeach
        <link href="{{asset('admin/admin.min.css')}}" rel="stylesheet" type="text/css"/>
        <!-- END THEME LAYOUT STYLES -->

        <link rel="shortcut icon" type="image/png" href="{{asset('favicon/favicon-32x32.png')}}"/>

        <link href="{{asset('croper/cropper.min.css')}}" rel="stylesheet">
        <script src="{{asset('croper/cropper.min.js')}}"></script>
        {{-- Includable CSS --}}
        @yield('styles')
        @yield('head')
        <link rel="apple-touch-icon" sizes="57x57" href="{{asset('favicon/apple-icon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{asset('favicon/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{asset('favicon/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{asset('favicon/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{asset('favicon/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{asset('favicon/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{asset('favicon/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{asset('favicon/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('favicon/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicon/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}">
        <link rel="manifest" href="{{asset('favicon/manifest.json')}} ">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{asset('favicon/ms-icon-144x144.png')}}">
        <meta name="theme-color" content="#ffffff">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    </head>

    <body {{ Metronic::printAttrs('body') }} {{ Metronic::printClasses('body') }}>

        @if (config('layout.page-loader.type') != '')
            @include('layouts.partials._page-loader')
        @endif

        @include('layouts.base._layout')


        <script>var HOST_URL = "{{ route('system_admin.quick-search') }}";</script>
        <script>
            UrlForScripts='{{url('/')}}';
            UrlForAssets='{{url('/')}}';

        </script>


        {{-- Global Config (global config for global JS scripts) --}}
        <script>
            var KTAppSettings = {!! json_encode(config('layout.js'), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!};
        </script>

        {{-- Global Theme JS Bundle (used by all pages)  --}}
        @foreach(config('layout.resources.js') as $script)
            <script src="{{ asset($script) }}" type="text/javascript"></script>
        @endforeach
        <script>
            const Swal=swal.mixin({
                buttonsStyling: false,
                confirmButtonClass: "{{config('layout.classes.submit')}}",
                confirmButtonColor: null,
                cancelButtonClass: "{{config('layout.classes.cancel')}}",
                cancelButtonColor: null
            });
        </script>
{{--        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>--}}
        <script src="{{asset('admin/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('admin/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('admin/jquery-validation/js/localization/messages_ar.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('admin/jquery.minicolors.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('admin/datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('admin/datepicker/locales/bootstrap-datepicker.ar.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('ckeditor/translations/en.js')}}"></script>
        <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
        <script src="{{asset('admin/main.js')}}" type="text/javascript"></script>



        @include('flash::message')
        {{-- Includable JS --}}
{{--        @include('layouts.partials.pusher')--}}


        @yield('custom_scripts')
        @yield('upload1_scripts')
        @yield('upload2_scripts')
        @yield('area_scripts')
        @yield('graph_js')
        <script>


            @if(count($errors->all()))
                @php
                $err='<ul class="text-right mb-5" style="padding:0 20px;">';
                foreach ($errors->all() as $e){
                    $err.='<li>'.$e.'</li>';
                }
                $err.='</ul>'
                @endphp
            Swal.fire({
                toast:true,
                html: '{!! $err !!}',
                icon: 'error',
                timer: 30000,
                position:'bottom-start',
                timerProgressBar: true,
                showConfirmButton: false,
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            @endif
        </script>

        @include('layouts.partials.firebase_notification')
        @yield('scripts')
        <script>
                $(document).ready(function (){
                    $('.isNumber').keydown(function(event) {
                            var charCode = event.keyCode;
                            console.log(charCode);
                            if(charCode>=96 && charCode<=105 ){
                                return true;
                            }
                            if ((charCode > 31 && (charCode < 48 || charCode > 57 )) || charCode==192 ) {
                                return false;
                            }
                            return true;
                    });
                });
        </script>
    </body>
</html>

