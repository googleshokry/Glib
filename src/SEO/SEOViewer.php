<?php

namespace Glib\SEO;

use Glib\SEO\Contracts\SEOable;
use Glib\Support\Text;

/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 19/04/18
 * Time: 03:31 م
 */
class SEOViewer
{
    private static $_instance;
    /**
     * @var string
     */
    private $title;
    /**
     * @var array
     */
    private $keyword = [];
    /**
     * @var string
     */
    private $description;

    public static function viewFromSEOableObject($title, SEOable $SEOable)
    {

        $seo = $SEOable->getSeo();
        if (is_null($seo)) {return self::instance($title,[], "");
        }
        return self::instance($title, $seo->getKeyWords()->toArray(), $seo->getDescription());
    }

    public static function instance($title = "", array $keyword = [], $description = "")
    {
        if (!self::$_instance)
            self::$_instance = new  static();


        return self::$_instance->setTitle($title)->setDescription($description)->setKeyword($keyword);

    }

    /**
     * @return static
     */
    public static function getInstance()
    {
        return self::$_instance ?? new static();
    }

    private function __construct($title = "", array $keyword = [], $description = "")
    {

        $this->title = $title;
        $this->keyword = $keyword;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return array
     */
    public function getKeyword(): array
    {
        return $this->keyword;
    }

    /**
     * @param array $keyword
     * @return $this
     */
    public function setKeyword(array $keyword)
    {
        $this->keyword = $keyword;
        return $this;
    }

    /**
     * @return Text
     */
    public function getDescription(): Text
    {
        return Text::make($this->description);
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getKeyWordAsString()
    {
        return implode(",", $this->getKeyword());
    }
}