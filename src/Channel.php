<?php

namespace Lucinda\RSS;

/**
 * Encapsulates a RSS channel tag according to specifications:
 * https://www.rssboard.org/rss-profile#element-channel
 */
class Channel implements Tag
{
    private string $title;
    private string $link;
    private string $description;
    private ?string $language = null;
    private ?string $copyright = null;
    private ?string $managingEditor = null;
    private ?string $webMaster = null;
    private ?string $pubDate = null;
    private ?string $lastBuildDate = null;
    private ?string $category = null;
    private ?string $generator = null;
    private ?string $docs = null;
    private ?Cloud $cloud = null;
    private ?int $ttl = null;
    private ?Image $image = null;
    private ?TextInput $textInput = null;
    private ?SkipHours $skipHours = null;
    private ?SkipDays $skipDays = null;
    /**
     * @var Item[]
     */
    private array $item = [];
    /**
     * @var Tag[]
     */
    private array $extra = [];

    /**
     * Sets channel's required information: title, link and description
     *
     * @param string $title       Sets the title of feed
     * @param string $link        URL of website associated with the feed
     * @param string $description Sets a description for feed
     */
    public function __construct(string $title, string $link, string $description)
    {
        $this->title = $title;
        $this->link = $link;
        $escaped = new Escape($description);
        $this->description = (string) $escaped;
    }

    /**
     * Sets channel language (locale) according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-language
     *
     * @param string $language ISO language code
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    /**
     * Sets copyright rules according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-copyright
     *
     * @param string $copyright Name of copyright owner
     */
    public function setCopyright(string $copyright): void
    {
        $this->copyright = $copyright;
    }

    /**
     * Sets managing editor's email according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-managingeditor
     *
     * @param  string $email Email of managing editor
     * @throws Exception
     */
    public function setManagingEditor(string $email): void
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
     * @param  string $email Email of webmaster
     * @throws Exception
     */
    public function setWebMaster(string $email): void
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
    public function setPubDate(int $unixTime): void
    {
        $this->pubDate = date("r (T)", $unixTime);
    }

    /**
     * Sets date content was last updated in channel by corresponding UNIX time according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-lastbuilddate
     *
     * @param int $unixTime UNIX time at which content was last updated
     */
    public function setLastBuildDate(int $unixTime): void
    {
        $this->lastBuildDate = date("r (T)", $unixTime);
    }

    /**
     * Sets category channel belongs to according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-category
     *
     * @param string $category Category channel belongs to
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    /**
     * Sets software that generated feed according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-generator
     *
     * @param string $generator Software that generated feed
     */
    public function setGenerator(string $generator): void
    {
        $this->generator = $generator;
    }

    /**
     * Sets url to documentation related to channel according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-docs
     *
     * @param  string $url Url to documentation related to channel
     * @throws Exception
     */
    public function setDocs(string $url): void
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
    public function setCloud(Cloud $cloud): void
    {
        $this->cloud = $cloud;
    }

    /**
     * Sets how long a channel can be cached before refreshing, in minutes (eg: 60) according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-ttl
     *
     * @param  integer $number
     * @throws Exception
     */
    public function setTtl(int $number): void
    {
        if ($number < 0) {
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
    public function setImage(Image $image): void
    {
        $this->image = $image;
    }

    /**
     * Sets text input box that will be displayed with channel according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-textinput
     *
     * @param TextInput $textInput Encapsulated RSS textInput tag
     */
    public function setTextInput(TextInput $textInput): void
    {
        $this->textInput = $textInput;
    }

    /**
     * Sets hours aggregator must ignore channel according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-skiphours
     *
     * @param SkipHours $skipHours Encapsulated RSS skipHours tag
     */
    public function setSkipHours(SkipHours $skipHours): void
    {
        $this->skipHours = $skipHours;
    }

    /**
     * Sets week days aggregator must ignore channel according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-skipdays
     *
     * @param SkipDays $skipDays Encapsulated RSS skipDays tag
     */
    public function setSkipDays(SkipDays $skipDays): void
    {
        $this->skipDays = $skipDays;
    }

    /**
     * Adds item to channel according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-item
     *
     * @param Item $item Encapsulated RSS item tag
     */
    public function addItem(Item $item): void
    {
        $this->item[] = $item;
    }

    /**
     * Adds a custom tag not part of RSS 2.0 specifications
     *
     * @param Tag $tag
     */
    public function addCustomTag(Tag $tag): void
    {
        $this->extra[] = $tag;
    }

    /**
     * {@inheritDoc}
     *
     * @see Tag::__toString()
     */
    public function __toString(): string
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
                    if ($v1 instanceof Tag) {
                        $output .= $v1;
                    } else {
                        $output .= "<".$key.">".$v1."</".$key.">";
                    }
                }
            } elseif ($value instanceof Tag) {
                $output .= $value;
            } else {
                $output .= "<".$key.">".$value."</".$key.">";
            }
        }
        return "<channel>".$output."</channel>";
    }
}
