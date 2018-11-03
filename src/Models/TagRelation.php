<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 19/04/18
 * Time: 05:23 م
 */

namespace Glib\Models;


class TagRelation extends BaseModel
{


    protected $table = "tags-relations";

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getWords()
    {
        return $this->belongsTo(Tag::class,"tag_id");
    }

}