<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 5/9/18
 * Time: 3:44 PM
 */

namespace Glib\Controllers;


/**
 * @property string relation
 */
class TableColumn
{

    private $type = "text";
    private $order = false;
    private $hasFilterd = false;
    private $data = [];
    private $alisa ;
    private $relation ;
    private $val;
    private $vis=true;

    /**
     * @return static
     */
    public static function make()
    {
        return new static();
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    public function getVisiable(): string
    {
        return $this->vis;
    }


    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return bool
     */
    public function isOrder(): bool
    {
        return $this->order;
    }


    public function setOrder()
    {
        $this->order = true;
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    /**
     * @return $this
     */
    public function filter()
    {
        $this->hasFilterd = true;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFilter()
    {
        return $this->hasFilterd;
    }

    /**
     * @return $this
     */
    public function image()
    {
        return $this->setType("image");
    }

    /**
     * @return $this
     */
    public function select()
    {
        return $this->setType("select");
    }

    /**
     * @return string
     */
    public function getAlisa(): ?string
    {
        return $this->alisa;
    }

    /**
     * @return string
     */
    public function getVal(): ?array
    {
        return $this->val;
    }

    public function getRelation(): ?string
    {
        return $this->relation;
    }

    /**
     * @param string $alisa
     * @return $this
     */
    public function setAlisa(string $alisa)
    {
        $this->alisa = $alisa;
        return $this;
    }

    /**
     * @param array $val
     * @return $this
     */
    public function setVal(array $val)
    {
        $this->val = $val;
        return $this;
    }

    /**
     * @param string $rel
     * @return $this
     */
    public function setRelation(string $rel)
    {
        $this->relation = $rel;
        return $this;
    }

    /**
     * @param bool $vis
     * @return $this
     */
    public function setVisiable(bool $vis)
    {
        $this->vis = $vis;
        return $this;
    }

}