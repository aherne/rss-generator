<?php

namespace Lucinda\RSS;

/**
 * Encapsulates a RSS enclosure tag according to specifications:
 * https://www.rssboard.org/rss-profile#element-channel-enclosure
 */
class Enclosure implements Tag
{
    private string $url;
    private int $length;
    private string $type;

    /**
     * Enclosure constructor.
     *
     * @param  string  $url    Url says where the media object is located.
     * @param  integer $length Byte size of media object
     * @param  string  $type   Mime type of media object.
     * @throws Exception
     */
    public function __construct(string $url, int $length, string $type)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new Exception("Invalid managing editor");
        }
        $this->url = $url;
        $this->length = $length;
        $this->type = $type;
    }

    /**
     * {@inheritDoc}
     *
     * @see Tag::__toString()
     */
    public function __toString(): string
    {
        $output = "";
        $vars = get_object_vars($this);
        foreach ($vars as $key=>$value) {
            $output .= $key.'="'.$value.'" ';
        }
        return "<enclosure ".$output."/>";
    }
}
