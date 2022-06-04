<?php

namespace Test\Lucinda\RSS;

use Lucinda\RSS\Image;
use Lucinda\UnitTest\Result;

class ImageTest
{
    private $image;

    public function __construct()
    {
        $this->image = new Image("http://www.google.com", "test title", "http://www.google.com/asd.gif");
    }

    public function setWidth()
    {
        $this->image->setWidth(640);
        return new Result(true);
    }


    public function setHeight()
    {
        $this->image->setHeight(480);
        return new Result(true);
    }


    public function setDescription()
    {
        $this->image->setDescription("asdfgh");
        return new Result(true);
    }


    public function toString()
    {
        return new Result((string) $this->image == '<image><url>http://www.google.com</url><title>test title</title><link>http://www.google.com/asd.gif</link><width>640</width><height>480</height><description><![CDATA[asdfgh]]></description></image>');
    }

    public function __toString(): string
    {
        return "OK";
    }
}
