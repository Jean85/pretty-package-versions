<?php

namespace Jean85;

use PackageVersions\Versions;

class PrettyVersions
{
    public static function getShortVersion(string $packageName): string
    {
        return explode('@', Versions::getVersion($packageName))[0];
    }
}
