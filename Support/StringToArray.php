<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 23/04/18
 * Time: 03:48 م
 */

namespace Glib\Support;


class StringToArray
{
    private $data;

    public function __construct(string $data = null)
    {
        $this->data = $data;
    }


    public function getData()
    {
        return $this->data;
    }


    public function setData(string $data)
    {
        $this->data = $data;
    }

    /**
     * @param string $delimiter
     * @return array
     */
    public function toArray($delimiter = ",")
    {
        return explode($delimiter, $this->data);
    }

    /**
     * @param string $delimiter
     * @return \Illuminate\Support\Collection
     */
    public function toCollection($delimiter = ",")
    {
        return collect($this->toArray($delimiter));
    }

    public function __toString()
    {
        return $this->data;
}
}