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
     * @throws VersionMissingExceptionInterface When a package is provided ({@see ProvidedPackageException}) or replaced ({@see ReplacedPackageException})
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
        return new Version(
            self::getRootPackageName(),
            InstalledVersions::getRootPackage()['pretty_version'],
            InstalledVersions::getRootPackage()['reference']
        );
    }
}
