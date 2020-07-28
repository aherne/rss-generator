<?php
namespace Test\Lucinda\RSS;

use Lucinda\RSS\Escape;
use Lucinda\UnitTest\Result;

class EscapeTest
{
    public function __toString()
    {
        $tag = new Escape("<strong>asdf</strong>");
        return new Result((string) $tag == '<![CDATA[<strong>asdf</strong>]]>');
    }
}
