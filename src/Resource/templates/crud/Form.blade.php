@yield("formInputs")

@if((@$row instanceof \Glib\FeatureAble\Contracts\FeatureAble))

    <hr/>
    <h3 class="section_title">make {{str_singular($module)}} Featured</h3>
    <?php $input = "feature"; ?>
    @include("Glib::parts.formInput",["label"=>$input,"input"=>"<br/>".Form::checkbox($input,null,@$row->isFeature(),["class"=>"form-controlf "])])
@endif




@if((@$row instanceof \Glib\SEO\Contracts\SEOable))

    <hr/>
    <h3 class="section_title">{!! __t('SEO Section') !!}</h3>
    <?php $input = "seo_key"; ?>
    @include("Glib::parts.formInput",["label"=>$input,"input"=>Form::text($input,@$row->seo->keywords,["class"=>"form-control tagable"])])
    <?php $input = "seo_desc"; ?>
    @include("Glib::parts.formInput",["label"=>$input,"input"=>Form::textarea($input,@$row->seo->description,["class"=>"form-control" ,"row"=>3])])

@endif

@if((@$row instanceof \Glib\Tag\Contracts\Tagable))

    <hr/>
    <h3 class="section_title">{!! __t('Tags Section') !!}</h3>
    <?php $input = "tags"; ?>
    @include("Glib::parts.formInput",["label"=>$input,"input"=>Form::text($input,@$row->getTags(),["class"=>"form-control tagable"])])
@endif

