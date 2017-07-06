<?php

namespace Tests\Functional;

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

    public function testGetVersionWithShortCommit()
    {
        $version = PrettyVersions::getVersionWithShortCommit('phpunit/phpunit');

        $this->assertContains('@', $version);
        $explodedVersion = explode('@', $version);
        $this->assertCount(2, $explodedVersion);
        $this->assertRegExp('/^\d+(\.\d+)+$/', $explodedVersion[0]);
        $this->assertSame(7, strlen($explodedVersion[1]));
    }
}
