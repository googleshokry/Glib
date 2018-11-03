@extends("Glib::layouts.dashboard")


@section("content")
    @hasSection("header")
        @yield("header")
    @else

        <div class="row">
            <div style="margin-bottom: 10px" class="col-10 ">
                <a href="{{route("$scope.$module.create",request()->all())}}" class="pull-right btn btn-primary">
                    انشاء جديد</a>
            </div>
            <div class="col-12 ">
                <hr/>

            </div>

        </div>
    @endif


    {{--@hasSection("filter")--}}
    <form>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    @yield("filter")

                    @foreach($tableInformation as $k=>$v)

                        @if($v->isFilter())
                            @include("Glib::parts.FilterInput",["name"=>$k,"options"=>$v,"label"=>$v->getAlisa()??$k])
                        @endif
                    @endforeach

                    @includeIf("Glib::parts.FilterInput",["label"=>"عدد السجلات","name"=>"limit","options"=>tableColumn()->select()->setData(["5"=>"5","10"=>"10","25"=>"25","100"=>"100","250"=>"250"])->setAlisa('عدد السجلات')  ])
                </div>
                <hr/>
            </div>

            <div class="col-12 col-md-6 offset-md-6 col-lg-3 offset-md-9 text-center">
                <button type="submit" class=" btn btn-primary">البحث</button>
                @if(@$export==true)
                    <a class="btn btn-danger" target="_blank"
                       href="{{ route("$scope.admin.download",request()->query()) }}">استخراج</a>
                @endif
                <a href="{{ route("$scope.$module.index") }}" class=" btn btn-dark">اﻻفتراضي</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <br/>
        <div class="clearfix"></div>
    </form>
    {{--@endif--}}


    <div>
        {!! $rows->links() !!}
    </div>
    <table class="table  table-striped ">
        <thead>
        <tr>

            <th>
                # @includeIf("admin.parts.templates.orderCol",["name"=>"id","options"=>tableColumn()->setOrder()])</th>

            @foreach($tableInformation as $k=>$v)
                @if(@$v->getVisiable()==true)
                    <th>{{($v->getAlisa()??$k)}} @includeIf("admin.parts.templates.orderCol",["name"=>$k,"options"=>$v])</th>
                @endif
            @endforeach


            @if(isset($moreCols)&&is_array($moreCols))
                @foreach($moreCols as $colName=>$val)
                    <th>{{$colName}}</th>
                @endforeach
            @endif

            <th>الأوامر</th>

        </tr>
        </thead>
        <tbody>

        @foreach(@$rows as $row)

            <tr>
                <td>{{ $row->{"id"} }}</td>

                @foreach($tableInformation as $key=>$val)
                    <?php

                    if ($val->getVal()['func']) {
                        if ($val->getVal()['para'] == true) {
                            $rowValue = $row->{$val->getVal()['func']}($row->{$key});
                        } else {
                            $rowValue = $row->{$val->getVal()['func']}();
                        }
                    } else {
                        $rowValue = $row->{$key};
                    }

                    ?>
                    @if(@$val->getVisiable()==true)
                        <td>@includeIf("admin.parts.tableTypes.".$val->getType("type"),["rowValue"=>$rowValue])</td>
                    @endif
                @endforeach



                @if(isset($moreCols)&&is_array($moreCols))
                    @foreach($moreCols as $colName=>$val)


                        @if(is_callable($val))
                            <td>{!!  $val($row)!!}</td>
                        @else
                            <td>{!!  $val!!}</td>

                        @endif



                    @endforeach
                @endif

                <td style="width: 150px">
                    <div class="row">
                        <div class="col-6 " style="padding:2px;">
                            @if(@$copy==true)
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block copyLinkTrigger"
                                   data-url="{{url('/')}}/uploads/{{$row->image}}">نسخ</a>
                            @endif
                            @hasSection("view")
                                @yield("view")
                            @else
                                @include("Glib::Buttons.viewBtn")
                            @endif

                            @hasSection("edit")
                                @yield("edit")
                            @else
                                @include("Glib::Buttons.editBtn")
                            @endif
                        </div>

                        <div class="col-6 " style="padding: 2px;">

                            @if($row instanceof \Glib\Models\Contracts\Activable)
                                @includeIf("Glib::Buttons.active")
                            @endif
                            @if(@\Glib\UMS\UMS::instance()->getUser()->is_super_admin==1)
                                @includeIf("Glib::Buttons.deleteBtn")
                            @endif
                        </div>
                        @hasSection("btns")
                            @yield("btns")
                        @endif
                        @if(@$status==true)
                            <?php $input = 'status'; ?>
                            {!! Form::open(['route'=>"admin.dashboard.changeStatus", 'method' => 'post','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data'] ) !!}
                            <div class="col-6 " style="padding: 2px;">
                                <input name="id" type="hidden" value="{!! @$row->{"id"} !!}">
                                {!! Form::select($input, \translation(\App\Models\Dashboard::statues),null,["class"=>"form-control",'placeholder'=>__t('home.select')]) !!}
                                @include("Glib::Buttons.saveBtn",["value"=>"update","text"=>__t("home.change status")])

                            </div>
                            {!! Form::close() !!}
                            <div class="col-6 " style="padding: 2px;">
                                {{--    {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}--}}
                                {{--    @include("Glib::Buttons.saveBtn",["value"=>"update","text"=>__t("home.change status")])--}}
                            </div>
                            {!! Form::close() !!}

                            {!! Form::open(['route'=>"admin.dashboard.assignTo", 'method' => 'post','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data'] ) !!}

                            <div class="col-6 " style="padding: 2px;">
                                <?php $input = 'assign'; ?>
                                {!! Form::select($input,\App\Models\Admin::getList(),null,["class"=>"form-control",'placeholder'=>__t('home.select')]) !!}
                                <input name="id" type="hidden" value="{!! @$row->{"id"} !!}">
                            </div>

                            <div class="col-6 " style="padding: 2px;">
                                @include("Glib::Buttons.saveBtn",["value"=>"update","text"=>__t("home.assign")])
                            </div>
                            {!! Form::close() !!}
                        @endif
                    </div>
                </td>


            </tr>
        @endforeach

        </tbody>
    </table>
    <div>
        {!! $rows->links() !!}
    </div>


    @hasSection("footer")
        @yield("header")
    @else

    @endif

@stop

@section('js')
    <script>
        $('.copyLinkTrigger').click(function (e) {
            e.preventDefault();
            var dummyContent = $(this).attr('data-url');
            var dummy = $('<input>').val(dummyContent).appendTo('body').select();
            document.execCommand('copy')
        });
    </script>
@stop