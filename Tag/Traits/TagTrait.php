<?php

namespace Glib\Tag\Traits;

use Glib\Models\Tag;
use Glib\Models\TagRelation;

trait TagTrait
{
    protected $myTagObj;
    protected $tagsRelation;
    protected $oldTagsRelation;
    protected $tagIds = [];

    public function tag()
    {
        return $this->hasOne(TagRelation::class, "model_id")->whereModelName($this->getTable());
    }

    public function deleteTag()
    {
        return Tag::whereModel($this->getTable())->whereModelId($this->getId())->delete();
    }


    public function getTags()
    {
        if (!$this->myTagObj)
            $this->myTagObj = $this->tag;


        return $this->setTagString();
    }

    public function updateTagRecord()
    {

        $this->setOldTagRelation();

        $this->uporctTags(
            [

                "tags" => $this->setArrayObj(request()->tags),
            ],
            [
                "model_name" => $this->getTable(),
                "model_id" => $this->id
            ]
            ,
            $this->setArrayObjString(Tag::getName($this->tagIds))
        );
    }

    public function setTagString()
    {
        $data = [];

        $this->setOldTagRelation();
        foreach ($this->oldTagsRelation as $tag) {
            $data[] .= Tag::getName($tag->tag_id)->name;
        }
        $data = implode(",", $data);

        return $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getCollection()
    {
//        dd(collect(explode(",", $this->setTagString())));
        return collect(explode(",", $this->setTagString()));
    }

    public function setOldTagRelation()
    {
        if (!$this->myTagObj)
            $this->myTagObj = $this->tag;

        @$this->oldTagsRelation = @TagRelation::where('model_id', @$this->myTagObj->model_id)->select('tag_id')->get();
        $this->setTagsIdsToArray();
    }

    public function setArrayObj($string): array
    {
        return explode(',', $string);
    }

    public function setArrayObjString(array $tags): array
    {
        $arr = [];
        foreach ($tags as $k => $v) {
            $arr[] .= $v['name'];
        }
        return $arr;
    }

    public function setTagsIdsToArray()
    {
        foreach ($this->oldTagsRelation as $tag) {

            $this->tagIds[] .= $tag->tag_id;
        }
    }

    /**
     * @param array $newtags
     * @param array $data
     * @param $oldTags
     * @return mixed
     */
    public function uporctTags(array $newtags, array $data = [], $oldTags)
    {

        $arr = array_unique(array_merge($newtags['tags'], $oldTags));

        foreach ($arr as $tag) {


            $row = Tag::firstOrCreate(['name' => str_slug($tag)]);
            if(in_array($tag,$newtags['tags'])) {
                $TagRelation = TagRelation::firstOrCreate(['model_name' => $data['model_name'], 'model_id' => $data['model_id'], 'tag_id' => $row['id']]);
            } else {
                TagRelation::where('model_name', $data['model_name'])->where('model_id', $data['model_id'])->where('tag_id', $row->id)->delete();
            }
        }
        return $TagRelation;
    }
}