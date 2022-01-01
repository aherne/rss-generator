<?php
namespace Lucinda\RSS;

/**
 * Encapsulates a RSS feed itself according to specifications:
 * https://www.rssboard.org/rss-profile#element-rss
 */
class RSS implements Tag
{
    private Channel $channel;
    private array $namespaces = [];
    
    /**
     * Constructs feed based on mandatory RSS channel described by specification:
     * https://www.rssboard.org/rss-profile#element-channel
     *
     * @param Channel $channel Encapsulated channel RSS tag
     */
    public function __construct(Channel $channel)
    {
        $this->channel = $channel;
    }
    
    /**
     * Adds a RSS namespace able to be used in defining custom functionality to feed, as exemplified by specification:
     * https://www.rssboard.org/rss-profile#namespace-elements
     *
     * @param string $name Name of custom RSS namespace (without 'xmlns:')
     * @param string $url URL where specification is defined
     * @throws Exception
     */
    public function addNamespace(string $name, string $url): void
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new Exception("Docs is invalid");
        }
        $this->namespaces[$name] = $url;
    }
    
    /**
     * {@inheritDoc}
     * @see Tag::__toString()
     */
    public function __toString()
    {
        $attributes = 'version="2.0"';
        foreach ($this->namespaces as $name=>$url) {
            $attributes.=' xmlns:'.$name.'="'.$url.'"';
        }
        return '<?xml version="1.0" encoding="UTF-8"?><rss '.$attributes.'>'.$this->channel.'</rss>';
    }
}
