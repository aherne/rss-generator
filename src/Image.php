<?php
namespace Lucinda\RSS;

/**
 * Encapsulates a GIF/JPEG/PNG image that can be displayed with the channel according to specifications:
 * https://validator.w3.org/feed/docs/rss2.html#ltimagegtSubelementOfLtchannelgt
 *
 * @package Lucinda\RSS
 * @example http://www.landofcode.com/rss-reference/image-tag.php
 */
class Image implements Tag
{
    private $url;
    private $title;
    private $link;
    private $width;
    private $height;
    private $description;

    /**
     * Image constructor.
     * @param $url
     * @param $title
     * @param $link
     */
    public function __construct($url, $title, $link) {
        $this->url = $url;
        $this->title = $title;
        $this->link = $link;
    }

    /**
     * Sets image width in pixels.
     *
     * @param integer $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * Sets image height in pixels.
     *
     * @param integer $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * Sets image description (equivalent of 'title' attribute of img HTML tag)
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function toString() {
        $output = "";
        $parameters = get_object_vars($this);
        foreach($parameters as $key=>$value) {
            if(empty($value)) continue;
            $output .= "<".$key.">".$value."</".$key.">";
        }
        return "<image>".$output."</image>";
    }
}