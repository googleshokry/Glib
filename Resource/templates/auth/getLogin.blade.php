@extends("Glib::layouts.loginLayout")

@section("title","تسجيل الدخول")

@section("content")
    <form method="post">

        {!! csrf_field() !!}
        <div class="form-group">
            <label class="text-normal text-dark" style="float: right">الايميل</label>
            <input name="{{Glib\UMS\UMS::checkUser()->getLoginField()}}" class="form-control" placeholder="John Doe">
        </div>
        <div class="form-group">
            <label class="text-normal text-dark" style="float: right">كلمة المرور</label>
            <input name="password" type="password" class="form-control" placeholder="Password">
        </div>
        <div class="form-group">
            <label class="text-normal text-dark" style="float: right">الروبوت</label>
            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display() !!}
        </div>
        <div class="form-group">
            <div class="peers ai-c jc-sb fxw-nw">

                <div class="peer">
                    <button class="btn btn-primary" style="float: right">تسجيل الدخول</button>
                </div>

            </div>
        </div>
        {{--<div class="form-group">--}}
            {{--<div class="peers ai-c jc-sb fxw-nw ">--}}

                {{--<div class="peer" style="text-align: right">--}}
                    {{--You don`t have account<br/>--}}
                    {{--<a href="{{auther()->getScopeConfig()->registerUrl()}}" class="">Create new one</a>--}}
                {{--</div>--}}
                {{--<div class="peer" style="text-align: left">--}}
                    {{--Forget your password<br/>--}}
                    {{--<a href="{{auther()->getScopeConfig()->forgetPasswordUrl()}}" class="">Reset it</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

    </form>
@stop