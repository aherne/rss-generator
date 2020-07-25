<?php
namespace Lucinda\RSS;

/**
 * Encapsulates a RSS channel tag according to specifications:
 * https://www.rssboard.org/rss-profile#element-channel
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
    private $skipHours;
    private $skipDays;
    private $item = [];
    private $extra = [];

    /**
     * Sets channel's required information: title, link and description
     *
     * @param string $title Sets the title of feed
     * @param string $link URL of website associated with the feed
     * @param string $description Sets a description for feed
     */
    public function __construct($title, $link, $description)
    {
        $this->title = $title;
        $this->link = $link;
        $this->description = new Escape($description);
    }

    /**
     * Sets channel language (locale) according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-language
     *
     * @param string $language ISO language code
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * Sets copyright rules according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-copyright
     *
     * @param string $copyright Name of copyright owner
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;
    }

    /**
     * Sets managing editor's email according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-managingeditor
     *
     * @param string $email Email of managing editor
     */
    public function setManagingEditor($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid managing editor");
        }
        $this->managingEditor = $email;
    }

    /**
     * Sets web master's email according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-webmaster
     *
     * @param string $webMaster Email of webmaster
     */
    public function setWebMaster($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid managing editor");
        }
        $this->webMaster = $email;
    }

    /**
     * Sets date content was put to channel by corresponding UNIX time according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-pubdate
     *
     * @param int $unixTime UNIX time at which content was put to channel.
     */
    public function setPubDate($unixTime)
    {
        $this->pubDate = date("r (T)", $unixTime);
    }

    /**
     * Sets date content was last updated in channel by corresponding UNIX time according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-lastbuilddate
     *
     * @param int $unixTime UNIX time at which content was last updated
     */
    public function setLastBuildDate($unixTime)
    {
        $this->lastBuildDate = date("r (T)", $unixTime);
    }

    /**
     * Sets category channel belongs to according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-category
     *
     * @param string $category Category channel belongs to
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * Sets software that generated feed according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-generator
     *
     * @param string $generator Software that generated feed
     */
    public function setGenerator($generator)
    {
        $this->generator = $generator;
    }

    /**
     * Sets url to documentation related to channel according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-docs
     *
     * @param string $url Url to documentation related to channel
     */
    public function setDocs($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new Exception("Docs is invalid");
        }
        $this->docs = $url;
    }

    /**
     * Sets web service supporting rssCloud interface according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-cloud
     *
     * @param Cloud $cloud Encapsulated RSS cloud tag
     */
    public function setCloud(Cloud $cloud)
    {
        $this->cloud = $cloud;
    }

    /**
     * Sets how long a channel can be cached before refreshing, in minutes (eg: 60) according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-ttl
     *
     * @param integer $number
     */
    public function setTtl($number)
    {
        if (!is_int($number) || $number < 0) {
            throw new Exception("Ttl is invalid");
        }
        $this->ttl = $number;
    }

    /**
     * Sets image logo that will be displayed with channel according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-image
     *
     * @param Image $image Encapsulated RSS image tag
     */
    public function setImage(Image $image)
    {
        $this->image = $image;
    }

    /**
     * Sets text input box that will be displayed with channel according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-textinput
     *
     * @param Input $textInput Encapsulated RSS textInput tag
     */
    public function setTextInput(Input $textInput)
    {
        $this->textInput = $textInput;
    }

    /**
     * Sets hours aggregator must ignore channel according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-skiphours
     *
     * @param SkipHours $skipHours Encapsulated RSS skipHours tag
     */
    public function setSkipHours(SkipHours $skipHours)
    {
        $this->skipHours = $skipHours;
    }

    /**
     * Sets week days aggregator must ignore channel according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-skipdays
     *
     * @param SkipDays $skipDays Encapsulated RSS skipDays tag
     */
    public function setSkipDays(SkipDays $skipDays)
    {
        $this->skipDays = $skipDays;
    }

    /**
     * Adds item to channel according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-item
     *
     * @param Item $item Encapsulated RSS item tag
     */
    public function addItem(Item $item)
    {
        $this->item[] = $item;
    }

    /**
     * Adds a custom tag not part of RSS 2.0 specifications
     *
     * @param Tag $tag
     */
    public function addCustomTag(Tag $tag)
    {
        $this->extra[] = $tag;
    }
        
    /**
     * {@inheritDoc}
     * @see \Lucinda\RSS\Tag::__toString()
     */
    public function __toString()
    {
        $output = "";
        $parameters = get_object_vars($this);
        foreach ($parameters as $key=>$value) {
            if (empty($value)) {
                continue;
            }
            if ($key == "extra") {
                foreach ($value as $v) {
                    $output .= $v;
                }
            } elseif (is_array($value)) {
                foreach ($value as $v1) {
                    $output .= "<".$key.">".$v1."</".$key.">";
                }
            } else {
                $output .= "<".$key.">".$value."</".$key.">";
            }
        }
        return "<channel>".$output."</channel>";
    }
}
