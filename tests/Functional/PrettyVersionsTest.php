<?php

declare(strict_types=1);

namespace Tests\Functional;

use Composer\InstalledVersions;
use Jean85\PrettyVersions;
use PHPUnit\Framework\TestCase;

class PrettyVersionsTest extends TestCase
{
    public function testVersion(): void
    {
        $version = PrettyVersions::getVersion('phpunit/phpunit');

        $this->assertSame('phpunit/phpunit', $version->getPackageName());
        $expectedFullVersion = InstalledVersions::getPrettyVersion('phpunit/phpunit')
            . '@'
            . InstalledVersions::getReference('phpunit/phpunit');
        $this->assertSame($expectedFullVersion, $version->getFullVersion());
    }

    public function testVersionLetsExceptionRaise(): void
    {
        $this->expectException(\Throwable::class);

        PrettyVersions::getVersion('non-existent-vendor/non-existent-package');
    }

    public function testGetRootPackageName(): void
    {
        $this->assertSame('jean85/pretty-package-versions', PrettyVersions::getRootPackageName());
    }

    public function testGetRootPackageVersion(): void
    {
        $version = PrettyVersions::getRootPackageVersion();

        $this->assertSame('jean85/pretty-package-versions', $version->getPackageName());
        $this->assertEquals(PrettyVersions::getVersion('jean85/pretty-package-versions'), $version);
    }
}
