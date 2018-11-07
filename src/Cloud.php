<?php
namespace Lucinda\RSS;

/**
 * Encapsulates a RSS web service that supports the rssCloud interface according to specifications:
 * https://validator.w3.org/feed/docs/rss2.html#ltcloudgtSubelementOfLtchannelgt
 * Its purpose is to allow processes to register with a cloud to be notified of updates to the channel,
 * implementing a lightweight publish-subscribe protocol for RSS feeds.
 *
 * @package Lucinda\RSS
 * @example http://www.landofcode.com/rss-reference/cloud-tag.php
 */
class Cloud implements Tag
{
    private $domain;
    private $port;
    private $path;
    private $registerProcedure;
    private $protocol;

    /**
     * Cloud constructor.
     *
     * @param string $domain Domain name of RSS cloud provider
     * @param integer $port Port to connect on that domain
     * @param string $path Url to connect to on that domain
     * @param string $registerProcedure RSS register procedure on that url
     * @param string $protocol Protocol to be used in connecting to domain.
     */
    public function __construct($domain, $port, $path, $registerProcedure, $protocol) {
        $this->domain = $domain;
        $this->port = $port;
        $this->path = $path;
        $this->registerProcedure = $registerProcedure;
        $this->protocol = $protocol;
    }

    public function toString()
    {
        $output = "";
        $vars = get_object_vars($this);
        foreach($vars as $key=>$value) {
            $output .= $key.'="'.$value.'" ';
        }
        return "<cloud ".$output."/>";
    }
}