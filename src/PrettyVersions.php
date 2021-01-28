<?php

declare(strict_types=1);

namespace Jean85;

use Composer\InstalledVersions;
use Jean85\Exception\ProvidedPackageException;
use Jean85\Exception\ReplacedPackageException;
use Jean85\Exception\VersionMissingExceptionInterface;

class PrettyVersions
{
    /**
     * @throws VersionMissingExceptionInterface
     */
    public static function getVersion(string $packageName): Version
    {
        if (isset(InstalledVersions::getRawData()['versions'][$packageName]['provided'])) {
            throw ProvidedPackageException::create($packageName);
        }

        if (isset(InstalledVersions::getRawData()['versions'][$packageName]['replaced'])) {
            throw ReplacedPackageException::create($packageName);
        }

        return new Version(
            $packageName,
            InstalledVersions::getPrettyVersion($packageName),
            InstalledVersions::getReference($packageName)
        );
    }

    public static function getRootPackageName(): string
    {
        return InstalledVersions::getRootPackage()['name'];
    }

    public static function getRootPackageVersion(): Version
    {
        return self::getVersion(self::getRootPackageName());
    }
}
