<?php

namespace Jean85;

use Composer\InstalledVersions;

class PrettyVersions
{
    const SHORT_COMMIT_LENGTH = 7;

    public static function getVersion(string $packageName): VersionInterface
    {
        $packageData = InstalledVersions::getRawData()['versions'][$packageName] ?? [];
        
        if (empty($packageData)) {
            throw new PackageNotInstalledException('Package "' . $packageName . '" is not installed');
        }

        if (array_key_exists('pretty_version', $packageData)) {
            return new Version($packageName, $packageData['pretty_version'] . '@' . $packageData['reference'] ?? '');
        }

        if (array_key_exists('provided', $packageData)) {
            $providedVersions = $packageData['provided'];
            return new ProvidedPackageVersion($packageName, array_pop($providedVersions));
        }

        if (array_key_exists('replaced', $packageData)) {
            $providedVersions = $packageData['replaced'];
            return new ReplacedPackageVersion($packageName, array_pop($providedVersions));
        }

        throw new \RuntimeException('Package "' . $packageName . '" is installed but has inconsistent data');
    }
}
