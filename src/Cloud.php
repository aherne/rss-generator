<?php
namespace Lucinda\RSS;

/**
 * Encapsulates a RSS cloud tag according to specifications:
 * https://www.rssboard.org/rss-profile#element-channel-cloud
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
    public function __construct($domain, $port, $path, $registerProcedure, $protocol)
    {
        $this->domain = $domain;
        $this->port = $port;
        $this->path = $path;
        $this->registerProcedure = $registerProcedure;
        $this->protocol = $protocol;
    }
    
    /**
     * {@inheritDoc}
     * @see \Lucinda\RSS\Tag::__toString()
     */
    public function __toString()
    {
        $output = "";
        $vars = get_object_vars($this);
        foreach ($vars as $key=>$value) {
            $output .= $key.'="'.$value.'" ';
        }
        return "<cloud ".$output."/>";
    }
}
