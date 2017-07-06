<?php

namespace Jean85;

use PackageVersions\Versions;

class PrettyVersions
{
    const SHORT_COMMIT_LENGTH = 7;

    public static function getShortVersion(string $packageName): string
    {
        return explode('@', Versions::getVersion($packageName))[0];
    }

    public static function getVersionWithShortCommit(string $packageName): string
    {
        $version = Versions::getVersion($packageName);
        $atPosition = strpos($version, '@');

        return substr($version, 0, $atPosition + 1 + self::SHORT_COMMIT_LENGTH);
    }
}
