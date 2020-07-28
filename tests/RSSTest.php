<?php
namespace Test\Lucinda\RSS;

use Lucinda\RSS\RSS;
use Lucinda\RSS\Channel;
use Lucinda\UnitTest\Result;

class RSSTest
{
    private $object;
    
    public function __construct()
    {
        $this->object = new RSS(new Channel("test title", "https://www.lucinda-framework.com", "test description"));
    }

    public function addNamespace()
    {
        $this->object->addNamespace("atom", "http://www.w3.org/2005/Atom");
        return new Result(true);
    }
        

    public function __toString()
    {
        return new Result((string) $this->object == '<?xml version="1.0" encoding="UTF-8"?><rss version="2.0 xmlns:atom="http://www.w3.org/2005/Atom"><channel><title>test title</title><link>https://www.lucinda-framework.com</link><description><![CDATA[test description]]></description></channel></rss>');
    }
}
