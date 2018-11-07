<?php
namespace Lucinda\RSS;
require_once("Tag.php");
require_once("Item.php");
require_once("Cloud.php");
require_once("Image.php");
require_once("Input.php");

/**
 * Encapsulates a RSS channel according to specifications:
 * https://validator.w3.org/feed/docs/rss2.html
 *
 * @package Lucinda\RSS
 */
class Channel implements Tag
{
    private $title;
    private $link;
    private $description;
    private $language;
    private $copyright;
    private $managingEditor;
    private $webMaster;
    private $pubDate;
    private $lastBuildDate;
    private $category;
    private $generator;
    private $docs;
    private $cloud;
    private $ttl;
    private $image;
    private $textInput;
    private $skipHours = [];
    private $skipDays = [];
    private $item = [];
    private $extra = [];

    /**
     * Sets channel's required information: title, link and description
     *
     * @param string $title
     * @param string $link
     * @param string $description
     */
    public function __construct($title, $link, $description)
    {
        $this->title = $title;
        $this->link = $link;
        $this->description = $description;
    }

    /**
     * Sets channel language (locale)
     *
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * Gets copyright rules
     *
     * @param string $copyright
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;
    }

    /**
     * Sets managing editor's email
     *
     * @param string $managingEditor
     */
    public function setManagingEditor($managingEditor)
    {
        $this->managingEditor = $managingEditor;
    }

    /**
     * Sets web master's email
     *
     * @param mixed $webMaster
     */
    public function setWebMaster($webMaster)
    {
        $this->webMaster = $webMaster;
    }

    /**
     * Sets date content was put to channel
     *
     * @param string $pubDate
     */
    public function setPubDate($pubDate)
    {
        $this->pubDate = $pubDate;
    }

    /**
     * Sets date content was put to channel
     *
     * @param string $lastBuildDate
     */
    public function setLastBuildDate($lastBuildDate)
    {
        $this->lastBuildDate = $lastBuildDate;
    }

    /**
     * Gets category channel belongs to (eg: Newspapers)
     *
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * Gets category channel belongs
     *
     * @param mixed $generator
     */
    public function setGenerator($generator)
    {
        $this->generator = $generator;
    }

    /**
     * Sets url to documentation related to channel
     *
     * @param string $docs
     */
    public function setDocs($docs)
    {
        $this->docs = $docs;
    }

    /**
     * Sets web service supporting rssCloud interface
     *
     * @param Cloud $cloud
     */
    public function setCloud(Cloud $cloud)
    {
        $this->cloud = $cloud;
    }

    /**
     * Sets how long a channel can be cached before refreshing, in minutes (eg: 60)
     *
     * @param integer $ttl
     */
    public function setTtl($ttl)
    {
        $this->ttl = $ttl;
    }

    /**
     * Sets image that will be displayed with channel
     *
     * @param Image $image
     */
    public function setImage(Image $image)
    {
        $this->image = $image;
    }

    /**
     * Sets text input box that will be displayed with channel
     *
     * @param Input $textInput
     */
    public function setTextInput($textInput)
    {
        $this->textInput = $textInput;
    }

    /**
     * Sets hours aggregator must ignore channel
     *
     * @param integer[] $skipHours
     */
    public function setSkipHours($skipHours)
    {
        $this->skipHours = $skipHours;
    }

    /**
     * Sets week days aggregator must ignore channel
     *
     * @param string[] $skipDays
     */
    public function setSkipDays($skipDays)
    {
        $this->skipDays = $skipDays;
    }

    /**
     * Adds item to channel.
     *
     * @param Item $item
     */
    public function addItem($item) {
        $this->item[] = $item;
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
        return "<channel>".$output."</channel>";
    }
}