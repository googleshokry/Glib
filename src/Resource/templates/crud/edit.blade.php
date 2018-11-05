@extends("Glib::layouts.dashboard")


@section('content')


    <div class="panel">
        <div class="panel-header">
            <i class="icon-check"></i>
            <h2>{{__t('Edit')}}</h2>
            <hr/>
        </div>
        <div class="panel-content">
            {!! Form::model(@$row,['url' => route("$scope.$module.update",[$module=>@$row->id]), 'method' => 'post','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data'] ) !!}
            {!! Form::hidden("_method","PUT") !!}
            @include("$scope.$module.form")
            <hr/>
            @hasSection('btns')
                @yield('btns')
            @else
            <div class="row">
                <div class="col-2">
                    @include("Glib::Buttons.CancelBtn")
                </div>
                <div class="col-2">
                    @include("Glib::Buttons.saveBtn",["value"=>"index","text"=>__t('Update')." ".__t(str_singular($module))])
                </div>
            </div>
            @endif
            {!! Form::close() !!}
            <hr/>
            @hasSection('deleteBtn')
                @yield('deleteBtn')
            @else
                <div class="row">
                    <div class="col-4">
                        @include("Glib::Buttons.deleteBtn")
                    </div>

                </div>
            @endif
        </div>
    </div>
@stop