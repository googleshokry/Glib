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
                    <th>{!! __t('answer') !!}</th>
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
                        <td><strong>{!! __t('SEO Section') !!}</strong></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>{!! __t('Keywords') !!}</td>
                        <td>
                            @foreach($row->getSeo()->getKeyWords()->toArray() as $keyword)
                                <span class="btn btn-sm btn-dark " style="cursor: auto"> {{$keyword}}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>{!! __t('description') !!}</td>
                        <td>{{$row->getSeo()->getDescription()}}</td>
                    </tr>
                @endif
                @if($row instanceof \Glib\Tag\Contracts\Tagable)
                    <tr>
                        <td>-------</td>
                        <td>-------</td>
                    </tr>
                    <tr>
                        <td><strong>{!! __t('Tags Section') !!}</strong></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>{!! __t('Keywords') !!}</td>
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
                        <td><strong>{!! __t('Comments') !!}</strong></td>
                        <td></td>
                    </tr>
                    <tr>
                        {{--<td>average</td><td>{{number_format($row->getReview()->avg->rate,1)}}</td>--}}
                    </tr>
                    <tr>
                        <table class="table  table-striped">
                            <thead>
                            <tr>
                                <th>{!! __t('Person') !!}</th>
                                <th>{!! __t('Rate') !!}</th>
                                <th>{!! __t('Comments') !!}</th>
                                <th>{!! __t('Files') !!}</th>
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
                        @include("Glib::parts.formInput",["label"=>__t('Comment'),"input"=>Form::text($input,@$row->{$input},["class"=>"form-control richText","placeholder"=>__t('Comment')])])

                        {!! Form::hidden('id',@$row->id) !!}
                        @include("Glib::Buttons.saveBtn",["value"=>"create","text"=>__t('Add')])


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