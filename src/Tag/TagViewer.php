<?php

namespace Glib\Tag;

use Glib\Tag\Contracts\Tagable;
use Glib\Support\Text;

class TagViewer
{
    private static $_instance;

    private $name;

    public static function viewFromTAGableObject(Tagable $tagable)
    {
        $tag = $tagable->getTag();
        return self::instance($tag->getKeyWords()->toArray());
    }

    public static function instance(array $name = [])
    {
        if (!self::$_instance)
            self::$_instance = new  static();


        return self::$_instance->setName($name);

    }

    /**
     * @return static
     */
    public static function getInstance()
    {
        return self::$_instance ?? new static();
    }

    private function __construct( array $name = [])
    {

        $this->name = $name;
    }



    /**
     * @return array
     */
    public function getName(): array
    {
        return $this->name;
    }


}