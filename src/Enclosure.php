<?php
namespace Lucinda\RSS;

class Enclosure implements Object
{
    private $url;
    private $length;
    private $type;

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