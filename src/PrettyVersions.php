<?php

declare(strict_types=1);

namespace Jean85;

use Composer\InstalledVersions;

class PrettyVersions
{
    public static function getVersion(string $packageName): Version
    {
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
