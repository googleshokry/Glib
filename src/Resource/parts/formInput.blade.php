<div class="{{$col ?? "col-7"}}">
    <div class="form-group">
        <label for="exampleInputEmail1">{{$label}}</label>
        {!! $input !!}
        <small id="emailHelp" class="form-text text-muted">
            {{$text ?? ""}}
        </small>
        {!! $more ?? "" !!}
    </div>
</div>