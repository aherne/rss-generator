<?php
namespace Lucinda\RSS;

/**
 * Encapsulates a RSS image tag according to specifications:
 * https://www.rssboard.org/rss-profile#element-channel-image
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
     * 
     * @param string $url URL of website presenting image
     * @param string $title Image textual description.
     * @param string $link URL pointing to image source.
     */
    public function __construct($url, $title, $link) {
        $this->url = $url;
        $this->title = $title;
        $this->link = $link;
    }

    /**
     * Sets image width in pixels.
     *
     * @param integer $width Value of image width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * Sets image height in pixels.
     *
     * @param integer $height Value of image height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * Sets image description (equivalent of 'title' attribute of img HTML tag)
     *
     * @param string $description Value of image textual description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    /**
     * {@inheritDoc}
     * @see \Lucinda\RSS\Tag::__toString()
     */
    public function __toString() {
        $output = "";
        $parameters = get_object_vars($this);
        foreach($parameters as $key=>$value) {
            if(empty($value)) continue;
            $output .= "<".$key.">".$value."</".$key.">";
        }
        return "<image>".$output."</image>";
    }
}