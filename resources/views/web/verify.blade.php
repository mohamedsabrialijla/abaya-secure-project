@extends('web.master')
@section('css')

@endsection

@section('content')
    <!--======================== Start login =============================-->
    <section class="login_page verify_page">
        <div class="container">
            <div class="content">
                <div class="box-form">
                    <div class="head">
                        <h5 class="bold">@lang('site.v1')</h5>
                    </div>
                    <form action="{{ route('verifyLogin') }}" method="POST" id="verify-form">
                        @csrf
                        <div class="text-center icon">
                            <img src="{{ asset('assets/img/icons/password.png') }}" alt="">
                        </div>
                        <input type="hidden" name="email" value="{{ Session::get('login_email') }}">
                        <input type="hidden" name="mobile" value="{{ Session::get('login_mobile') }}">
                        <!--<p style="font-weight:bold;font-size:18p;">رقم التحقق هو 1111</p>-->
                        <div class="veri_inputs">
                            <input type="text" class="verify-input-field" name="code1" required maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" data-index=1 />
                            <input type="text" class="verify-input-field" name="code2" required maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                            <input type="text" class="verify-input-field" name="code3" required maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                            <input type="text" class="verify-input-field" name="code4" required maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                        </div>

                        <button type="submit" class="main-btn submit-btn animate" id="send"><span>@lang('site.v2')</span></button>
                    </form>
                    <div class="details text-center mt-20">
                        <p>@lang('site.v3')</p>
                        <form action="{{ route('resendVerifyCode') }}" method="POST" id="resend-form">
                            @csrf

                        <input type="hidden" name="email" value="{{ Session::get('login_email') }}">
                        <input type="hidden" name="mobile" value="{{ Session::get('login_mobile') }}">
                        <a href="javascript:{}" onclick="document.getElementById('resend-form').submit();" class="resend main-color">@lang('site.v4')</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--======================== End login =============================-->
@endsection

@section('js')

<script>

    $('[data-index=1]').focus();

    const inputElements = [...document.querySelectorAll('input.verify-input-field')]

    inputElements.forEach((ele,index)=>{
    ele.addEventListener('keydown',(e)=>{
        // if the keycode is backspace & the current field is empty
        // focus the input before the current. Then the event happens
        // which will clear the "before" input box.
        if(e.keyCode === 8 && e.target.value==='') inputElements[Math.max(0,index-1)].focus()
    })
    ele.addEventListener('input',(e)=>{
        // take the first character of the input
        // this actually breaks if you input an emoji like 👨‍👩‍👧‍👦....
        // but I'm willing to overlook insane security code practices.
        const [first,...rest] = e.target.value
        e.target.value = first ?? '' // first will be undefined when backspace was entered, so set the input to ""
        const lastInputBox = index===inputElements.length-1
        const didInsertContent = first!==undefined
        if(didInsertContent && !lastInputBox) {
        // continue to input the rest of the string
        inputElements[index+1].focus()
        inputElements[index+1].value = rest.join('')
        inputElements[index+1].dispatchEvent(new Event('input'))
        }
    })
    })


    // mini example on how to pull the data on submit of the form

    // function onSubmit(e){
    // e.preventDefault()
    // const code = inputElements.map(({value})=>value).join('')
    // console.log(code)
    // }
</script>

@endsection
