{!! Form::model($row,["url"=>route("$scope.$module.destroy",[$module=>$row->id])]) !!}
{!! Form::hidden("_method","DELETE") !!}
<button class="btn btn-danger confirmBtn btn-block btn-sm">{!! __t("Delete") !!}</button>
{!! Form::close() !!}