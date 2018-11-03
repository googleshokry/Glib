@extends("Glib::layouts.dashboard")


@section('content')
    {{--@if ($errors->any())--}}
    {{--<div class="alert alert-danger">--}}
    {{--<ul>--}}
    {{--@foreach ($errors->all() as $error)--}}
    {{--<li>{{ $error }}</li>--}}
    {{--@endforeach--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--@endif--}}

    <div class="panel">
        <div class="panel-header">
            <i class="icon-check"></i>
            <h2>{{("انشاء جديد")}}</h2>
            <hr/>
        </div>
        <div class="panel-content">
            {{--            {!! Form::model($row,['url' => $scope.'/'.$module, 'method' => 'post','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data'] ) !!}--}}
            {!! Form::model(@$row,['url' =>route("$scope.$module.store",request()->query()), 'method' => 'post','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data'] ) !!}
            @foreach(request()->query() as $k => $v)
                {!! Form::hidden($k,$v) !!}
            @endforeach
            @include("$scope.$module.form")
            <hr/>
            <div class="clear-fix"></div>
            <div class="row">
                @hasSection("btns")
                    @yield("btns")
                @else
                    <div class="col-3">
                        @include("Glib::Buttons.saveBtn",["value"=>"create","text"=>"حفظ و انشاء جديد "])
                    </div>
                    <div class="col-2">
                        @include("Glib::Buttons.saveBtn",["value"=>"index","text"=>"حفظ و الرجوع الي السجلات"])
                    </div>
                    <div class="col-12 ">
                        <hr/>
                    </div>
                    <div class=" col-2">
                        @include("Glib::Buttons.CancelBtn")
                    </div>
                @endif
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop