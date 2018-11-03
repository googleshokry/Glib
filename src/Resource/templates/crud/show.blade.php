@extends("Glib::layouts.dashboard")
<?php

/**
 * @var  \Glib\Models\Contracts\HTMLAble $row
 */

?>

@section('content')
    <div class="row">

    </div>

    <div class="row">
        <div class="col-9">
            <table class="table  table-striped">
                <thead>
                <tr>
                    <th></th>
                    <th>اﻻجابة</th>
                </tr>
                </thead>
                <tbody>

                @foreach($row->toArray() as $key=>$val)

                    @unless(in_array($key,$row->getHTMLPresenter()->restrictedInfo()))

                        <tr>
                            @if(in_array($key,array_keys($row->getHTMLPresenter()->aliases())))

                                @if(is_array($currentAttr  =$row->getHTMLPresenter()->aliases()[$key] ))
                                    <td>{!!$currentAttr["name"] !!}</td>
                                    <td>{!! $currentAttr["value"] !!}</td>
                                @else
                                    <td>{!!$key !!}</td>
                                    <td>{!! $row->getHTMLPresenter()->aliases()[$key] !!}</td>
                                @endif
                            @else
                                <td>{!!$key !!}</td>
                                <td>{!! $val !!}</td>
                            @endif


                        </tr>

                    @endunless

                @endforeach
                {{--{{dd($aliases)}}--}}
                @if($row instanceof \Glib\SEO\Contracts\SEOable&&!is_null($row->getSeo()))
                    <tr>
                        <td>-------</td>
                        <td>-------</td>
                    </tr>
                    <tr>
                        <td><strong>SEO Section</strong></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Key words</td>
                        <td>
                            @foreach($row->getSeo()->getKeyWords()->toArray() as $keyword)
                                <span class="btn btn-sm btn-dark " style="cursor: auto"> {{$keyword}}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>description</td>
                        <td>{{$row->getSeo()->getDescription()}}</td>
                    </tr>
                @endif
                @if($row instanceof \Glib\Tag\Contracts\Tagable)
                    <tr>
                        <td>-------</td>
                        <td>-------</td>
                    </tr>
                    <tr>
                        <td><strong>Tags Section</strong></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Key words</td>
                        <td>
                            @foreach($row->getCollection() as $tagname)
                                <span class="btn btn-sm btn-dark " style="cursor: auto"> {{$tagname}}</span>
                            @endforeach
                        </td>
                    </tr>
                @endif
                {{--{{ dd($row->getReview()) }}--}}
                @if($row instanceof \Glib\Review\Contracts\Reviewable&&!is_null($row->getReview()))
                    <tr>
                        <td>-------</td>
                        <td>-------</td>
                    </tr>
                    <tr>
                        <td><strong>التعليقات</strong></td>
                        <td></td>
                    </tr>
                    <tr>
                        {{--<td>average</td><td>{{number_format($row->getReview()->avg->rate,1)}}</td>--}}
                    </tr>
                    <tr>
                        <table class="table  table-striped">
                            <thead>
                            <tr>
                                <th>الشخص</th>
                                {{--<th>Rate</th>--}}
                                <th>التلعيقات</th>
                                <th>الملفات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($row->getComments() as $review)
                                <tr>
                                    <td>@if(@$review->getUser()->name){{@$review->getUser()->name }}@else {{__t('home.reporter')}} @endif</td>

                                    <td>{{@$review->comment}}</td>
                                    <td>{!! @$review->MediaRow() !!}</td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>

                    </tr>
                    <tr>
                        {!! Form::model(@$row,['url' =>route("admin.admin.updateReviewRecord"), 'method' => 'post','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data'] ) !!}

                        <?php $input = "comment"; ?>
                        @include("Glib::parts.formInput",["label"=>'التعليق',"input"=>Form::text($input,@$row->{$input},["class"=>"form-control richText","placeholder"=>'التعليق'])])

                        {!! Form::hidden('id',@$row->id) !!}
                        @include("Glib::Buttons.saveBtn",["value"=>"create","text"=>"اضافه"])


                        {!! Form::close() !!}
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="col-3">
            <div class="col-10">
                @hasSection("edit")
                    @yield("edit")
                @else
                    @include("Glib::Buttons.editBtn")
                @endif
                @include("Glib::Buttons.deleteBtn")
                <hr>
                @include("Glib::Buttons.CancelBtn")
            </div>
        </div>
    </div>


@stop