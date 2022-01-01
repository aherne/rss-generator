<?php
namespace Test\Lucinda\RSS;

use Lucinda\RSS\SkipDays;
use Lucinda\UnitTest\Result;

class SkipDaysTest
{
    public function toString()
    {
        $object = new SkipDays(["Saturday", "Sunday"]);
        return new Result((string) $object == '<skipDays><day>Saturday</day><day>Sunday</day></skipDays>');
    }

    public function __toString(): string
    {
        return "OK";
    }
}
