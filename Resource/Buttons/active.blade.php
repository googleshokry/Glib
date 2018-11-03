<?php


/**
 * @var \Glib\Models\Contracts\Activable $row
 */

$status = $row->getStatus() ? 0 : 1;
$statusName = ($status) ? "active" : "deactivate";
$statusClass = ($status) ? "success" : "danger";


?>


{!! Form::model($row,["url"=>route("$scope.$module.statuses",["id"=>$row->id])]) !!}
{!! Form::hidden("_method","PATCH") !!}
{!! Form::hidden("status",$status) !!}
{!! Form::submit($statusName,["class"=>"btn btn-sm btn-block btn-$statusClass"]) !!}
{!! Form::close() !!}
