@extends("Glib::layouts.loginLayout")

@section("title","Forget Password")

@section("content")
    <form method="post">

        {!! csrf_field() !!}
        <div class="form-group">
            <label class="text-normal text-dark">{!! __t('Email') !!}</label>
            <input required name="email" type="email" class="form-control" placeholder="example@mail.com">
        </div>

        <div class="form-group">
            <div class="peers ai-c jc-sb fxw-nw">

                <div class="peer">
                    <button class="btn btn-primary">{!! __t('Reset') !!}</button>
                </div>

            </div>
        </div>

        <div class="form-group">
            <div class="peers ai-c jc-sb fxw-nw ">

                <div class="peer" style="text-align: right">
                    {!! __t('You don`t have account') !!}<br/>
                    <a href="{{auther()->getScopeConfig()->registerUrl()}}" class="">{!! __t('Create new one') !!}</a>
                </div>
                <div class="peer">
                    {!! __t('Already have account') !!}<br/>
                    <a href="{{auther()->getScopeConfig()->loginUrl()}}" class="">{!! __t('login here') !!}</a>
                </div>
            </div>
        </div>

    </form>
@stop