<?php
namespace Lucinda\RSS;
require_once("Enclosure.php");

/**
 * Encapsulates a RSS item according to specifications:
 * https://validator.w3.org/feed/docs/rss2.html#hrelementsOfLtitemgt
 *
 * @package Lucinda\RSS
 * @example http://www.landofcode.com/rss-reference/item-tag.php
 */
class Item implements Tag
{
    private $title;
    private $link;
    private $description;
    private $author;
    private $categories = [];
    private $comments;
    private $enclosure;
    private $guid;
    private $pubDate;
    private $source;
    private $extra = [];

    /**
     * Sets item's required information: title and description
     *
     * @param string $title Sets the title of the item
     * @param string $description Sets a description for the item
     */
    public function __construct($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Sets item URL
     *
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * Sets item author's email.
     *
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Sets categories item belongs to
     *
     * @param string[] $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * Sets url of the comments page for the item.
     *
     * @param string $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * Sets media object that is attached to the item.
     *
     * @param Enclosure $enclosure
     */
    public function setEnclosure($enclosure)
    {
        $this->enclosure = $enclosure;
    }

    /**
     * Sets unique item identifier
     *
     * @param string $guid
     */
    public function setGuid($guid)
    {
        $this->guid = $guid;
    }

    /**
     * Set date item was published.
     *
     * @param string $pubDate
     */
    public function setPubDate($pubDate)
    {
        $this->pubDate = $pubDate;
    }

    /**
     * Set item's source (reference)
     *
     * @param string $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * Sets an extra parameter not part of RSS 2.0 specifications
     *
     * @param string $key
     * @param mixed $value
     */
    public function setExtraParameter($key, $value) {
        $this->extra[$key] = $value;
    }

    public function toString() {
        $output = "";
        $parameters = get_object_vars($this);
        foreach($parameters as $key=>$value) {
            if(empty($value)) continue;
            if($key == "extra") {
                foreach($value as $k=>$v) {
                    $output .= ($v instanceof Object?$v->toString():"<".$k.">".$v."</".$k.">");
                }
            } else {
                $output .= ($value instanceof Object?$value->toString():"<".$key.">".$value."</".$key.">");
            }
        }
        return "<item>".$output."</item>";
    }
}