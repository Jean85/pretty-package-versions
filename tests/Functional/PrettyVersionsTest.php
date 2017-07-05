<?php

namespace Functional;

use Jean85\PrettyVersions;
use PHPUnit\Framework\TestCase;

class PrettyVersionsTest extends TestCase
{
    public function testGetShortVersion()
    {
        $version = PrettyVersions::getShortVersion('phpunit/phpunit');
        
        $this->assertNotContains('@', $version);
        $this->assertRegExp('/^\d+(\.\d+)+$/', $version);
    }
}
