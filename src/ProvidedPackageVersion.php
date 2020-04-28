<?php

namespace Jean85;

class ProvidedPackageVersion implements VersionInterface
{
    /** @var string */
    private $packageName;

    /** @var string */
    private $version;

    public function __construct(string $packageName, string $version)
    {
        $this->packageName = $packageName;
        $this->version = $version;
    }

    public function getPackageName(): string
    {
        return $this->packageName;
    }

    public function getPrettyVersion(): string
    {
        return $this->version;
    }

    public function getFullVersion(): string
    {
        return $this->version;
    }

    public function getVersionWithShortCommit(): string
    {
        return $this->version;
    }

    public function getShortVersion(): string
    {
        return $this->version;
    }

    public function getCommitHash(): string
    {
        return '';
    }

    public function getShortCommitHash(): string
    {
        return '';
    }
}
