<?php
namespace Lucinda\RSS;

/**
 * Encapsulates a RSS enclosure according to specifications:
 * https://validator.w3.org/feed/docs/rss2.html#ltenclosuregtSubelementOfLtitemgt
 * Defines a media object that is attached to the item
 *
 * @package Lucinda\RSS
 * @example http://www.landofcode.com/rss-reference/enclosure-tag.php
 */
class Enclosure implements Tag
{
    private $url;
    private $length;
    private $type;

    /**
     * Enclosure constructor.
     * @param string $url Url says where the media object is located.
     * @param integer $length Byte size of media object
     * @param string $type Mime type of media object.
     */
    public function __construct($url, $length, $type) {
        $this->url = $url;
        $this->length = $length;
        $this->type = $type;
    }

    public function toString()
    {
        $output = "";
        $vars = get_object_vars($this);
        foreach($vars as $key=>$value) {
            $output .= $key.'="'.$value.'" ';
        }
        return "<enclosure ".$output."/>";
    }
}