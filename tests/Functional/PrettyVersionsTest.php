<?php

namespace Tests\Functional;

use Composer\InstalledVersions;
use Jean85\PrettyVersions;
use Jean85\Version;
use PHPUnit\Framework\TestCase;

class PrettyVersionsTest extends TestCase
{
    public function testVersion()
    {
        $packageName = 'phpunit/phpunit';
        $version = PrettyVersions::getVersion($packageName);

        $this->assertInstanceOf(Version::class, $version);
        $this->assertSame($packageName, $version->getPackageName());
        $this->assertSame(InstalledVersions::getPrettyVersion($packageName), $version->getPrettyVersion());
        $this->assertSame(InstalledVersions::getReference($packageName), $version->getCommitHash());
    }

    public function testVersionLetsExceptionRaise()
    {
        $this->expectException(\Throwable::class);

        PrettyVersions::getVersion('non-existent-vendor/non-existent-package');
    }
}
