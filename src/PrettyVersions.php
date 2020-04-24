<?php

namespace Jean85;

use Composer\InstalledVersions;

class PrettyVersions
{
    const SHORT_COMMIT_LENGTH = 7;

    public static function getVersion(string $packageName): Version
    {
        $version = InstalledVersions::getPrettyVersion($packageName) . '@' . InstalledVersions::getReference($packageName);
        
        return new Version($packageName, $version);
    }
}
