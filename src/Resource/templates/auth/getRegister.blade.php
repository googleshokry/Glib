@extends("Glib::layouts.loginLayout")

@section("title","Register")

@section("content")
    <form method="post">

        {!! csrf_field() !!}
        <div class="form-group">
            <label class="text-normal text-dark">{!! __t('Email') !!}</label>
            <input required name="email" type="email" class="form-control" placeholder="example@mail.com" value="{{old("email")}}">
        </div>
        <div class="form-group">
            <label class="text-normal text-dark">{!! __t('Password') !!}</label>
            <input name="password" type="password" class="form-control" placeholder="Password">
        </div>

        <div class="form-group">
            <label class="text-normal text-dark">{!! __t('Re-Password') !!}</label>
            <input name="password_confirmation" type="password" class="form-control" placeholder="Password">
        </div>
        <div class="form-group">
            <div class="peers ai-c jc-sb fxw-nw">

                <div class="peer">
                    <button class="btn btn-primary">{!! __t('Login') !!}</button>
                </div>

                <div class="peer">
                    {!! __t('Already have account') !!}
                    <a href="{{auther()->getScopeConfig()->loginUrl()}}" class="">{!! __t('Login here') !!}</a>
                </div>
            </div>
        </div>
    </form>
@stop