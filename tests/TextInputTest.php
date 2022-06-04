<?php

namespace Test\Lucinda\RSS;

use Lucinda\UnitTest\Result;
use Lucinda\RSS\TextInput;

class TextInputTest
{
    public function toString()
    {
        $input = new TextInput("a", "b", "https://www.yahoo.com", "c");
        return new Result((string) $input == '<textInput><name>a</name><title>b</title><link>https://www.yahoo.com</link><description><![CDATA[c]]></description></textInput>');
    }

    public function __toString(): string
    {
        return "OK";
    }
}
