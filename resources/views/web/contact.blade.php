@extends('web.master')
@section('css')

@endsection
@section('title')
@lang('site.contact')
@endsection
@section('content')

    <!--======================== Start breadcrumb =============================-->
    <div class="breadcrumb pt-10 pb-10">
        <div class="container">
            <div class="product-navigation">
                <ul class="breadcrumb breadcrumb-lg m-0">
                    <li><a href="demo1.html"><i class="fal fa-home"></i></a></li>
                    <li>@lang('site.contact')</li>
                </ul>
            </div>
        </div>
    </div>
    <!--======================== End breadcrumb =============================-->

    <!--======================== Start Page Header =============================-->
    <section class="page_header" style="background-image: url({{ asset('assets/img/contact-us.jpg') }});">
        <div class="container content h-100">
            <h4 class="page_name m-0">@lang('site.contact')</h4>
        </div>
    </section>
    <!--======================== End Page Header =============================-->

    <!--======================== Start contact =============================-->
    <section class="contact_page login_page mt-50">
        <div class="container">
            {{-- <h2 class="section-title heading-border wow fadeInUp">@lang('site.c1')</h2>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="icon-box text-center">
                        <span class="icon-box-icon">
                            <i class="fal fa-envelope"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">@lang('site.email')</h4>
                            <p>mail@example.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="icon-box text-center">
                        <span class="icon-box-icon">
                            <i class="fal fa-phone"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">رقم الهاتف</h4>
                            <p>(996) 456-7890 / (996) 456-9870</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="icon-box text-center">
                        <span class="icon-box-icon">
                            <i class="fal fa-map-marker-alt"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">العنوان</h4>
                            <p>السعودية - المدينة</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="icon-box text-center">
                        <span class="icon-box-icon">
                            <i class="fal fa-fax"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">رقم فاكس</h4>
                            <p>(996) 456-7890</p>
                        </div>
                    </div>
                </div>
            </div> --}}
{{--
            <hr class="divider mb-50 mt-30"> --}}
            <div class="content">
                <div class="box-form">
                    <div class="head">
                        <h5 class="bold">@lang('site.c2')</h5>
                    </div>
                    <form action="{{ route('send_msg') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">@lang('site.name')</label>
                            <input class="form-control" name="name" type="text"  placeholder="@lang('site.name')" required="">
                        </div>
                        <div class="form-group">
                            <label for="">@lang('site.phone_number')</label>
                            <input class="form-control" name="phone_number" type="text"  placeholder="@lang('site.phone_number')" required="">
                        </div>
                        <div class="form-group">
                            <label for="">@lang('site.email')</label>
                            <input class="form-control" type="email" name="email" placeholder="user@example.com" required="">
                        </div>
                        <div class="form-group">
                            <label for="">@lang('site.msg')</label>
                            <textarea class="form-control" name="msg" placeholder="@lang('site.c3')"" required=""></textarea>
                        </div>
                        <button type="submit" class="main-btn submit-btn animate" id="send"><span>@lang('site.send')</span></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--======================== End contact =============================-->
@endsection

@section('js')
<script>
    $(`[data-index=1]`).focus();

    $('.verify-input-field').keypress(function(e) {
        var ew = e.which;
        if (48 <= ew && ew <= 57)
            return true;
        return false;

        let inputBoxIndex = $(e.target).attr('data-index');
        let inputBox = $(e.target);

        if (inputBox.val().length > 0) {
            e.preventDefault();
        }
    })




    $('.verify-input-field').keyup(function(e) {

        let inputBoxIndex = $(e.target).attr('data-index');
        let pressedKeyCode = e.keyCode | e.which;
        let nextInputBox = $(`[data-index=${Number(inputBoxIndex) + 1}]`);
        let prevInputBox = $(`[data-index=${Number(inputBoxIndex) - 1}]`);

        if (48 <= pressedKeyCode && pressedKeyCode <= 57) {
            nextInputBox.focus();
        } else if (pressedKeyCode === 8 || pressedKeyCode === 37) {
            prevInputBox.focus();
        }

    })
</script>

@endsection
