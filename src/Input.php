<?php
namespace Lucinda\RSS;

//http://www.landofcode.com/rss-reference/textinput-tag.php
class Input implements Object
{
    private $name;
    private $title;
    private $link;
    private $description;

    public function __construct($name, $title, $link, $description)
    {
        $this->name = $name;
        $this->title = $title;
        $this->link = $link;
        $this->description = $description;
    }

    public function toString() {
        $output = "";
        $parameters = get_object_vars($this);
        foreach($parameters as $key=>$value) {
            $output .= "<".$key.">".$value."</".$key.">";
        }
        return "<textInput>".$output."</textInput>";
    }
}