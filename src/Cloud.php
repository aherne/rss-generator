<?php
namespace Lucinda\RSS;


class Cloud implements Object
{
    private $domain;
    private $port;
    private $path;
    private $registerProcedure;
    private $protocol;

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