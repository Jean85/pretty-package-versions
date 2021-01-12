<?php

namespace Jean85;

use Composer\InstalledVersions;

class PrettyVersions
{
    const SHORT_COMMIT_LENGTH = 7;

    public static function getVersion(string $packageName): Version
    {
        return new Version($packageName, InstalledVersions::getVersion($packageName));
    }

    public static function getRootPackageName(): string
    {
        return InstalledVersions::getRootPackage();
    }

    public static function getRootPackageVersion(): Version
    {
        return self::getVersion(InstalledVersions::getRootPackage());
    }
}
