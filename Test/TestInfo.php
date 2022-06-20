<?php

use PHPUnit\Framework\TestCase;
use Payeer\Trade\Trade;

class TestInfo extends TestCase
{
    public function testFailure()
    {
        $trade = new Trade();
        $this->assertIsArray($trade->Info('BTC_RUB'));
    }
}
