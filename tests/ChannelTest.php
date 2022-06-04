<?php

namespace Test\Lucinda\RSS;

use Lucinda\RSS\Cloud;
use Lucinda\RSS\Image;
use Lucinda\RSS\TextInput;
use Lucinda\RSS\SkipHours;
use Lucinda\RSS\SkipDays;
use Lucinda\RSS\Item;
use Lucinda\RSS\Tag;
use Lucinda\RSS\Channel;
use Lucinda\UnitTest\Result;

class ChannelTest
{
    private $channel;

    public function __construct()
    {
        $this->channel = new Channel("my title", "http://www.google.com", "my description");
    }

    public function setLanguage()
    {
        $this->channel->setLanguage("en");
        return new Result(true);
    }


    public function setCopyright()
    {
        $this->channel->setCopyright("lucinda(c)");
        return new Result(true);
    }


    public function setManagingEditor()
    {
        $this->channel->setManagingEditor("a@a.com");
        return new Result(true);
    }


    public function setWebMaster()
    {
        $this->channel->setManagingEditor("b@b.com");
        return new Result(true);
    }


    public function setPubDate()
    {
        $this->channel->setPubDate(strtotime("2020-01-02 03:04:05"));
        return new Result(true);
    }


    public function setLastBuildDate()
    {
        $this->channel->setPubDate(strtotime("2020-02-03 04:05:06"));
        return new Result(true);
    }


    public function setCategory()
    {
        $this->channel->setCategory("cat");
        return new Result(true);
    }


    public function setGenerator()
    {
        $this->channel->setGenerator("gen");
        return new Result(true);
    }


    public function setDocs()
    {
        $this->channel->setDocs("https://www.google.com");
        return new Result(true);
    }


    public function setCloud()
    {
        $this->channel->setCloud(new Cloud("server.example.com", 80, "/rpc", "cloud.notify", "xml-rpc"));
        return new Result(true);
    }


    public function setTtl()
    {
        $this->channel->setTtl(123);
        return new Result(true);
    }


    public function setImage()
    {
        $this->channel->setImage(new Image("http://dallas.example.com/masthead.gif", "Dallas Times-Herald", "http://dallas.example.com"));
        return new Result(true);
    }


    public function setTextInput()
    {
        $this->channel->setTextInput(new TextInput("a", "b", "https://www.yahoo.com", "c"));
        return new Result(true);
    }


    public function setSkipHours()
    {
        $this->channel->setSkipHours(new SkipHours([0,1,2]));
        return new Result(true);
    }


    public function setSkipDays()
    {
        $this->channel->setSkipDays(new SkipDays(["Saturday", "Sunday"]));
        return new Result(true);
    }


    public function addItem()
    {
        $this->channel->addItem(new Item("zzz", "xxx"));
        return new Result(true);
    }


    public function addCustomTag()
    {
        $this->channel->addCustomTag(
            new class () implements Tag {
                public function __toString()
                {
                    return "<custom>hello</custom>";
                }
            }
        );
        return new Result(true);
    }

    public function toString()
    {
        return new Result(((string) $this->channel) == '<channel><title>my title</title><link>http://www.google.com</link><description><![CDATA[my description]]></description><language>en</language><copyright>lucinda(c)</copyright><managingEditor>b@b.com</managingEditor><pubDate>Mon, 03 Feb 2020 04:05:06 +0200 (EET)</pubDate><category>cat</category><generator>gen</generator><docs>https://www.google.com</docs><cloud domain="server.example.com" port="80" path="/rpc" registerProcedure="cloud.notify" protocol="xml-rpc" /><ttl>123</ttl><image><url>http://dallas.example.com/masthead.gif</url><title>Dallas Times-Herald</title><link>http://dallas.example.com</link></image><textInput><name>a</name><title>b</title><link>https://www.yahoo.com</link><description><![CDATA[c]]></description></textInput><skipHours><hour>0</hour><hour>1</hour><hour>2</hour></skipHours><skipDays><day>Saturday</day><day>Sunday</day></skipDays><item><title>zzz</title><description><![CDATA[xxx]]></description></item><custom>hello</custom></channel>');
    }

    public function __toString(): string
    {
        return "OK";
    }
}
