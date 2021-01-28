<?php

declare(strict_types=1);

namespace Jean85;

use Composer\InstalledVersions;

class PrettyVersions
{
    public static function getVersion(string $packageName): Version
    {
        $version = InstalledVersions::getPrettyVersion($packageName);
        if ($version === null) {
            $version = explode(' || ', InstalledVersions::getVersionRanges($packageName))[0] ?? 'unknown';
        }

        return new Version(
            $packageName,
            $version,
            InstalledVersions::getReference($packageName) ?? 'unknown'
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
