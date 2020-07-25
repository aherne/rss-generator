<?php
namespace Lucinda\RSS;

/**
 * Encapsulates a RSS enclosure tag according to specifications:
 * https://www.rssboard.org/rss-profile#element-channel-enclosure
 */
class Enclosure implements Tag
{
    private $url;
    private $length;
    private $type;

    /**
     * Enclosure constructor.
     *
     * @param string $url Url says where the media object is located.
     * @param integer $length Byte size of media object
     * @param string $type Mime type of media object.
     */
    public function __construct($url, $length, $type)
    {
        $this->url = $url;
        $this->length = $length;
        $this->type = $type;
    }
    
    /**
     * {@inheritDoc}
     * @see \Lucinda\RSS\Tag::__toString()
     */
    public function __toString()
    {
        $output = "";
        $vars = get_object_vars($this);
        foreach ($vars as $key=>$value) {
            $output .= $key.'="'.$value.'" ';
        }
        return "<enclosure ".$output."/>";
    }
}
