<?php
namespace Test\Lucinda\RSS;

use Lucinda\RSS\Cloud;
use Lucinda\UnitTest\Result;

class CloudTest
{
    public function toString()
    {
        $cloud = new Cloud("server.example.com", 80, "/rpc", "cloud.notify", "xml-rpc");
        return new Result(((string) $cloud) == '<cloud domain="server.example.com" port="80" path="/rpc" registerProcedure="cloud.notify" protocol="xml-rpc" />');
    }

    public function __toString(): string
    {
        return "OK";
    }
}
