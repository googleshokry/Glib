<?php
/**
 * Created by PhpStorm.
 * User: EngShokry
 * Date: 22/04/18
 * Time: 06:52 م
 */

namespace Glib\Support;


use Illuminate\Support\Str;
use Glib\Upload\MediaFile;

class Text
{
    /**
     * @var string
     */
    private $text;

    public function __construct(string $text = null)
    {
        $this->text = $text ?? "";
    }

    public static function make(string $text = null)
    {
        return new static($text);
    }

    public function __toString()
    {
        return $this->text;
    }

    /**
     * @param null $name
     * @param array $options
     * @return string
     */
    public function asLinkTag($name = null, array $options = [])
    {
        return MediaFile::make($this->text)->getAsLinkTag($name, $options);
    }

    public function asPlainText(): string
    {
        return strip_tags($this->text);
    }


    public function limit($number = 100, $end = '...'): self
    {
        return self::make(str_limit($this->asPlainText(), $number, $end));
    }

    public function upperCase(): self
    {
        return self::make(Str::upper($this->asPlainText()));
    }


}