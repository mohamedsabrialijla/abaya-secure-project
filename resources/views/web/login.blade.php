@extends('web.master')
@section('css')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />
<style>
   #captcha {
  border-radius: 5px;
  border: 1px solid gainsboro;
  display: flex;
  align-items: center;
  justify-content: center;
}
input[type="text"] {
  padding: 12px 20px;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
  width: 100%;
  margin: 12px 0;
}
button {
  background-color: #2f66f5;
  border: none;
  color: white;
  padding: 12px 30px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
  width: 100%;
  border-radius: 5px;
}
canvas {
  pointer-events: none;
}

</style>
@endsection
@section('title')
@lang('site.login-register')
@endsection
@section('content')

    <!--======================== Start login =============================-->
    <section class="login_page" onload="createCaptcha()">
        <div class="container">
            <div class="content">
                <div class="box-form">
                    {{-- @dd(Auth::guard('user')->check()) --}}
                    <div class="head">
                        <h5 class="bold">@lang('site.login-register')</h5> 
                        <!--kljkljkl-->
                    </div>
                    <!--<form action="{{ route('loginRegister') }}" method="POST" onsubmit="return validateCaptcha(this);">-->
                        <form action="{{ route('loginRegister') }}" method="POST" >
                        @csrf
                        <div class="form-group box-content " id="email-content">
                            <label for="">@lang('site.email')</label>
                            <div class="input-box">
                                <span class="icon"><i class="fal fa-envelope"></i></span>
                                <input class="form-control" name="email" type="email" value="" placeholder="user@example.com">
                            </div>
                        </div>
                        <div class="form-group box-content active" id="phone-content">
                            <label for="">@lang('site.phone_number')</label>
                            <div class="input-box">
                                <select name="mobile_code" id="">
                                    <option value="966">966</option>
                                    <option value="965">965</option>
                                    <option value="971">971</option>
                                    <option value="974">974</option>
                                    <option value="973">973</option>
                                </select>
                                <span class="icon"><i class="fal fa-phone"></i></span>
                                <input class="form-control" name="mobile"  onKeyPress="if(this.value.length==9) return false;" type="number" value="" placeholder="56xxxxxxxxxx">

                            </div>
                        </div>
                        
                        
<!--                 <div class="container">-->
<!--    <div style="width:100%; display: flex; justify-content: space-between;">-->
<!--        <div id="captcha">-->
<!--        </div>-->
<!--        <a class="regenerateCaptchaBtn main-btn submit-btn animate" style="width: 5rem;" onclick="createCaptcha()">-->
<!--            <i class="fas fa-redo"></i>-->
<!--        </a>-->
<!--    </div>-->
<!--    <input class="form-control" style="background:inherit" type="text" placeholder="Enter Captcha  ادخل كلمة التحقق" id="cpatchaTextBox" />-->
    
<!--</div>-->
                      
                        

                        <div class="form-group">
                            <button type="submit" class="main-btn submit-btn animate" id="send" ><span>@lang('site.verify')</span></button>
                        </div>
                        <div class="register-div text-center">
                            <p class="btn  m-0" data-content="phone-content"> @lang('site.or_login')<span class="bold main-color pointer d-block">@lang('site.phone_number')</span></p>
                            <p class="btn active m-0" data-content="email-content"> @lang('site.or_login')<span class="bold main-color pointer d-block">@lang('site.email')</span></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--======================== End login =============================-->

@endsection

@section('js')
<script>
$( document ).ready(function() {
    createCaptcha();
});

    var code;

function createCaptcha() {
    // alert('aef')ajkdfsdkjg
    // clear the contents of captcha div first 
    document.getElementById('captcha').innerHTML = "";
    var charsArray =
        "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!#$%^&*";
    var lengthOtp = 6;
    var captcha = [];
    for (var i = 0; i < lengthOtp; i++) {
        //below code will not allow Repetition of Characters
        var index = Math.floor(Math.random() * charsArray.length + 1); //get the next character from the array
        if (captcha.indexOf(charsArray[index]) == -1)
            captcha.push(charsArray[index]);
        else i--;
    }
    var canv = document.createElement("canvas");
    canv.id = "captcha";
    canv.width = 100;
    canv.height = 50;
    var ctx = canv.getContext("2d");
    ctx.font = "25px Georgia";
    ctx.strokeText(captcha.join(""), 0, 30);
    //storing captcha so that can validate you can save it somewhere else according to your specific requirements
    code = captcha.join("");
    document.getElementById("captcha").appendChild(canv); // adds the canvas to the body element
}

function validateCaptcha(form) {
    event.preventDefault();
    if (document.getElementById("cpatchaTextBox").value == code) {
        form.submit();
    } else {
        alert("خطا في رقم التحقق يرجى المحاولة مرة أخرى");
        createCaptcha();
    }
}
// sdjlfhsdjkgjksdf
</script>

<script>
    $('.register-div .btn').on('click', function() {

        $(this).removeClass('active').siblings().addClass('active');

        var id = $(this).attr('data-content')

        $('.box-content[id="' + id + '"]').addClass('active').siblings().removeClass('active')

    })
</script>



@endsection
