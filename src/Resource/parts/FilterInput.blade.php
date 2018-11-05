
<?php

/**
 * @var \Glib\Controllers\TableColumn $options
 */


?>



<div class="col-3">
    <label>{{$label ??( $name ?? "")}}</label>

    @switch($options->getType())

        @case("select")
        {!! Form::select($name,$options->getData(),request()->get($name),["class"=>"form-control",'placeholder'=>__t('select')]) !!}
        @break
        @case("date")
        {!! Form::date($name, request()->get($name),["class"=>"form-control"]) !!}
        @break
        @default
        {!! Form::text($name,request()->get($name),["class"=>"form-control"]) !!}
    @endswitch



</div>