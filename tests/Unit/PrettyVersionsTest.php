<?php

declare(strict_types=1);

namespace Tests\Unit;

use Jean85\Exception\ProvidedPackageException;
use Jean85\PrettyVersions;
use PHPUnit\Framework\TestCase;

class PrettyVersionsTest extends TestCase
{
    public function testGetVersionOfReplacedPackage(): void
    {
        $this->expectException(\Throwable::class);

        PrettyVersions::getVersion('monolog/monolog');
    }

    public function testGetVersionOfProvidedPackage(): void
    {
        $this->expectException(ProvidedPackageException::class);
        $this->expectExceptionMessage('Cannot retrieve a version for package psr/log-implementation since it is provided, probably a metapackage');

        PrettyVersions::getVersion('psr/log-implementation');
    }
}
