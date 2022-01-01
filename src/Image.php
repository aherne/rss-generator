<?php
namespace Lucinda\RSS;

/**
 * Encapsulates a RSS image tag according to specifications:
 * https://www.rssboard.org/rss-profile#element-channel-image
 */
class Image implements Tag
{
    private string $url;
    private string $title;
    private string $link;
    private ?int $width;
    private ?int $height;
    private $description;

    /**
     * Image constructor.
     *
     * @param string $url URL of website presenting image
     * @param string $title Image textual description.
     * @param string $link URL pointing to image source.
     * @throws Exception
     */
    public function __construct(string $url, string $title, string $link)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new Exception("Invalid image url attribute");
        }
        $this->url = $url;
        $this->title = $title;
        if (!filter_var($link, FILTER_VALIDATE_URL)) {
            throw new Exception("Invalid image link attribute");
        }
        $this->link = $link;
    }

    /**
     * Sets image width in pixels.
     *
     * @param integer $width Value of image width
     * @throws Exception
     */
    public function setWidth(int $width): void
    {
        if ($width<=0) {
            throw new Exception("Image width should be greater than zero");
        }
        $this->width = $width;
    }

    /**
     * Sets image height in pixels.
     *
     * @param integer $height Value of image height
     * @throws Exception
     */
    public function setHeight(int $height): void
    {
        if ($height<=0) {
            throw new Exception("Image height should be greater than zero");
        }
        $this->height = $height;
    }

    /**
     * Sets image description (equivalent of 'title' attribute of img HTML tag)
     *
     * @param string $description Value of image textual description
     */
    public function setDescription(string $description): void
    {
        $escaped = new Escape($description);
        $this->description = (string) $escaped;
    }
    
    /**
     * {@inheritDoc}
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
            $output .= "<".$key.">".$value."</".$key.">";
        }
        return "<image>".$output."</image>";
    }
}
