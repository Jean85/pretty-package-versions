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

    public function testGetVersionOfProvidedPackageRegression()
    {
        $packageName = 'psr/log-implementation';
        $version = PrettyVersions::getVersion($packageName);

        $this->assertInstanceOf(Version::class, $version);
        $this->assertSame($packageName, $version->getPackageName());
        $this->assertSame('1.0.0', $version->getPrettyVersion());
        $this->assertSame('1.0.0', $version->getShortVersion());
        $this->assertSame('1.0.0', $version->getVersionWithShortCommit());
        $this->assertSame('1.0.0', $version->getFullVersion());
        $this->assertSame('', $version->getCommitHash());
        $this->assertSame('', $version->getShortCommitHash());
    }

    public function testGetVersionOfReplacedPackageRegression()
    {
        $packageName = 'monolog/monolog';
        $version = PrettyVersions::getVersion($packageName);

        $this->assertInstanceOf(Version::class, $version);
        $this->assertSame($packageName, $version->getPackageName());
        $this->assertSame('1.0.0', $version->getPrettyVersion());
        $this->assertSame('1.0.0', $version->getShortVersion());
        $this->assertSame('1.0.0', $version->getVersionWithShortCommit());
        $this->assertSame('1.0.0', $version->getFullVersion());
        $this->assertSame('', $version->getCommitHash());
        $this->assertSame('', $version->getShortCommitHash());
    }
}
