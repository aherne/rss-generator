<?php
namespace Lucinda\RSS;

/**
 * Encapsulates a RSS textInput tag according to specifications:
 * https://www.rssboard.org/rss-profile#element-channel-textinput
 */
class Input implements Tag
{
    private $name;
    private $title;
    private $link;
    private $description;

    /**
     * Input constructor.
     * @param string $name Name of the textbox
     * @param string $title Text to display on the submit button that will appear automatically next to the textbox
     * @param string $link The URL where the data input into the textbox will be sent
     * @param string $description Description for the textbox
     */
    public function __construct($name, $title, $link, $description)
    {
        $this->name = $name;
        $this->title = $title;
        $this->link = $link;
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
            $output .= "<".$key.">".$value."</".$key.">";
        }
        return "<textInput>".$output."</textInput>";
    }
}