<?php

namespace Test\Lucinda\RSS;

use Lucinda\RSS\Item;
use Lucinda\RSS\Tag;
use Lucinda\UnitTest\Result;
use Lucinda\RSS\Enclosure;

class ItemTest
{
    private $object;

    public function __construct()
    {
        $this->object = new Item("test title", "test description");
        return new Result(true);
    }

    public function setLink()
    {
        $this->object->setLink("https://www.google.com");
        return new Result(true);
    }


    public function setAuthor()
    {
        $this->object->setLink("https://www.flickr.com/aherne");
        return new Result(true);
    }


    public function setCategory()
    {
        $this->object->setCategory("newspaper");
        return new Result(true);
    }


    public function setComments()
    {
        $this->object->setComments("https://www.yahoo.com");
        return new Result(true);
    }


    public function setEnclosure()
    {
        $this->object->setEnclosure(new Enclosure("https://www.google.com/asd.jpg", 123456, "image/jpeg"));
        return new Result(true);
    }


    public function setGuid()
    {
        $this->object->setGuid("https://www.vk.com");
        return new Result(true);
    }


    public function setPubDate()
    {
        $this->object->setPubDate(strtotime("2020-01-02 03:04:05"));
        return new Result(true);
    }


    public function setSource()
    {
        $this->object->setSource("https://github.com/aherne");
        return new Result(true);
    }


    public function addCustomTag()
    {
        $this->object->addCustomTag(
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
        return new Result(((string) $this->object) == '<item><title>test title</title><description><![CDATA[test description]]></description><link>https://www.flickr.com/aherne</link><category>newspaper</category><comments>https://www.yahoo.com</comments><enclosure url="https://www.google.com/asd.jpg" length="123456" type="image/jpeg" /><guid>https://www.vk.com</guid><pubDate>Thu, 02 Jan 2020 03:04:05 +0200</pubDate><source>https://github.com/aherne</source><custom>hello</custom></item>');
    }

    public function __toString(): string
    {
        return "OK";
    }
}
