<?php
namespace Lucinda\RSS;

/**
 * Encapsulates a RSS item tag according to specifications:
 * https://www.rssboard.org/rss-profile#element-channel-item
 */
class Item implements Tag
{
    private $title;
    private $link;
    private $description;
    private $author;
    private $category;
    private $comments;
    private $enclosure;
    private $guid;
    private $pubDate;
    private $source;
    private $extra = [];

    /**
     * Sets item's required information: title and description
     *
     * @param string $title Sets the title of feed item
     * @param string $description Sets a description of feed item
     */
    public function __construct(string $title, string $description)
    {
        $this->title = $title;
        $this->description = new Escape($description);
    }

    /**
     * Sets item URL according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-item-url
     *
     * @param string $url URL of feed item.
     */
    public function setLink(string $url): void
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new Exception("Invalid feed url");
        }
        $this->link = $url;
    }

    /**
     * Sets item author's email according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-item-author
     *
     * @param string $email Author of feed item
     */
    public function setAuthor(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid feed author");
        }
        $this->author = $email;
    }

    /**
     * Sets category item belongs to according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-item-category
     *
     * @param string $category Category feed item belongs
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    /**
     * Sets url of the comments page for the item according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-item-url
     *
     * @param string $url URL of comments page of feed item
     */
    public function setComments(string $url): void
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new Exception("Invalid feed comments");
        }
        $this->comments = $url;
    }

    /**
     * Sets media object that is attached to the item according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-item-enclosure
     *
     * @param Enclosure $enclosure Encapsulated RSS enclosure tag
     */
    public function setEnclosure(Enclosure $enclosure): void
    {
        $this->enclosure = $enclosure;
    }

    /**
     * Sets unique identifier of feed item according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-item-guid
     *
     * @param string $guid Unique identifier of feed item
     */
    public function setGuid(string $guid): void
    {
        $this->guid = $guid;
    }

    /**
     * Set date item was published by corresponding UNIX time according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-item-pubdate
     *
     * @param int $unixTime UNIX time at which item was published.
     */
    public function setPubDate(int $unixTime): void
    {
        $this->pubDate = date("r (T)", $unixTime);
    }

    /**
     * Set item's source RSS url according to specifications:
     * https://www.rssboard.org/rss-profile#element-channel-item-source
     *
     * @param string $url
     */
    public function setSource(string $url): void
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new Exception("Invalid feed url");
        }
        $this->source = $url;
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
            } elseif ($value instanceof Tag) {
                $output .= $value;
            } else {
                $output .= "<".$key.">".$value."</".$key.">";
            }
        }
        return "<item>".$output."</item>";
    }
}
