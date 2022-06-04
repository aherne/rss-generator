<?php

namespace Test\Lucinda\RSS;

use Lucinda\RSS\Enclosure;
use Lucinda\UnitTest\Result;

class EnclosureTest
{
    public function toString()
    {
        $enclosure = new Enclosure("https://www.google.com/asd.jpg", 123456, "image/jpeg");
        return new Result((string) $enclosure == '<enclosure url="https://www.google.com/asd.jpg" length="123456" type="image/jpeg" />');
    }

    public function __toString(): string
    {
        return "OK";
    }
}
