<?php

declare(strict_types=1);

namespace Jean85;

class Version
{
    const SHORT_COMMIT_LENGTH = PrettyVersions::SHORT_COMMIT_LENGTH;

    /** @var string */
    private $packageName;

    /** @var string */
    private $prettyVersion;

    /** @var string */
    private $reference;

    /** @var bool */
    private $versionIsTagged;

    public function __construct(string $packageName, string $prettyVersion, string $reference)
    {
        $this->packageName = $packageName;
        $this->prettyVersion = $prettyVersion;
        $this->reference = $reference;
        $this->versionIsTagged = preg_match('/[^v\d\.]/', $this->getShortVersion()) === 0;
    }

    public function getPrettyVersion(): string
    {
        if ($this->versionIsTagged) {
            return $this->prettyVersion;
        }

        return $this->getVersionWithShortReference();
    }

    public function getFullVersion(): string
    {
        return $this->prettyVersion . '@' . $this->getReference();
    }

    public function getVersionWithShortReference(): string
    {
        return $this->prettyVersion . '@' . $this->getShortReference();
    }

    public function getPackageName(): string
    {
        return $this->packageName;
    }

    public function getShortVersion(): string
    {
        return $this->prettyVersion;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function getShortReference(): string
    {
        return substr($this->reference, 0, self::SHORT_COMMIT_LENGTH);
    }

    public function __toString(): string
    {
        return $this->getPrettyVersion();
    }
}
