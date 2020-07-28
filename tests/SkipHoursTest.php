<?php
namespace Test\Lucinda\RSS;

use Lucinda\RSS\SkipHours;
use Lucinda\UnitTest\Result;

class SkipHoursTest
{
    public function __toString()
    {
        $object = new SkipHours([0,1,2]);
        return new Result((string) $object == '<skipHours><hour>0</hour><hour>1</hour><hour>2</hour></skipHours>');
    }
}
