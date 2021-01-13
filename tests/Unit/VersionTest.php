<?php

namespace Tests\Unit;

use Jean85\Version;
use PHPUnit\Framework\TestCase;

class VersionTest extends TestCase
{
    const STABLE_VERSION = ['1.1.2', '51e867c70f0799790b3e82276875414ce13daaca'];
    const STABLE_VERSION_WITH_V =  ['v1.7.0', '93d39f1f7f9326d746203c7c056f300f7f126073'];
    const DEV_VERSION = ['9999999-dev', 'f6e77da35a8420cc1923c3ad3f13b1a191ff0311'];
    const REPLACE_VERSION = ['self.version', 'aaabbbcccddd'];

    public function testGetPackageName()
    {
        $version = new Version('vendor/package', 'v1.0', '51e867c70f0799790b3e82276875414ce13daaca');

        $this->assertSame('vendor/package', $version->getPackageName());
    }

    /**
     * @dataProvider fullVersionProvider
     */
    public function testGetFullVersion(string $prettyVersion, string $reference)
    {
        $version = new Version('vendor/package', $prettyVersion, $reference);

        $this->assertSame($prettyVersion . '@' . $reference, $version->getFullVersion());
    }

    public function fullVersionProvider(): array
    {
        return [
            self::STABLE_VERSION,
            self::STABLE_VERSION_WITH_V,
            self::DEV_VERSION,
            self::REPLACE_VERSION,
        ];
    }

    /**
     * @dataProvider prettyVersionProvider
     */
    public function testGetPrettyVersion(Version $version, string $expectedVersion)
    {
        $this->assertSame($expectedVersion, $version->getPrettyVersion());
    }

    /**
     * @dataProvider prettyVersionProvider
     */
    public function testToString(Version $version, string $expectedVersion)
    {
        $this->assertSame($expectedVersion, (string)$version);
    }

    public function prettyVersionProvider(): array
    {
        return [
            [$this->createVersion(self::STABLE_VERSION), '1.1.2'],
            [$this->createVersion(self::STABLE_VERSION_WITH_V), 'v1.7.0'],
            [$this->createVersion(self::DEV_VERSION), '9999999-dev@f6e77da'],
            [$this->createVersion(self::REPLACE_VERSION), 'self.version@aaabbbc'],
        ];
    }

    /**
     * @dataProvider versionWithShortCommitProvider
     */
    public function testGetVersionWithShortCommit(Version $version, string $expectedVersion)
    {
        $this->assertSame($expectedVersion, $version->getVersionWithShortCommit());
    }

    public function versionWithShortCommitProvider(): array
    {
        return [
            [$this->createVersion(self::STABLE_VERSION), '1.1.2@51e867c'],
            [$this->createVersion(self::STABLE_VERSION_WITH_V), 'v1.7.0@93d39f1'],
            [$this->createVersion(self::DEV_VERSION), '9999999-dev@f6e77da'],
            [$this->createVersion(self::REPLACE_VERSION), 'self.version@aaabbbc'],
        ];
    }

    /**
     * @dataProvider shortVersionProvider
     */
    public function testGetShortVersion(Version $version, string $expectedVersion)
    {
        $this->assertSame($expectedVersion, $version->getShortVersion());
    }

    public function shortVersionProvider(): array
    {
        return [
            [$this->createVersion(self::STABLE_VERSION), '1.1.2'],
            [$this->createVersion(self::STABLE_VERSION_WITH_V), 'v1.7.0'],
            [$this->createVersion(self::DEV_VERSION), '9999999-dev'],
            [$this->createVersion(self::REPLACE_VERSION), 'self.version'],
        ];
    }

    /**
     * @dataProvider commitHashProvider
     */
    public function testGetReference(Version $version, string $expectedReference)
    {
        $this->assertSame($expectedReference, $version->getReference());
    }

    public function commitHashProvider(): array
    {
        return [
            [$this->createVersion(self::STABLE_VERSION), '51e867c70f0799790b3e82276875414ce13daaca'],
            [$this->createVersion(self::STABLE_VERSION_WITH_V), '93d39f1f7f9326d746203c7c056f300f7f126073'],
            [$this->createVersion(self::DEV_VERSION), 'f6e77da35a8420cc1923c3ad3f13b1a191ff0311'],
            [$this->createVersion(self::REPLACE_VERSION), 'aaabbbcccddd'],
        ];
    }

    /**
     * @dataProvider shortCommitHashProvider
     */
    public function testGetShortReference(Version $version, string $expectedHash)
    {
        $this->assertSame($expectedHash, $version->getShortReference());
    }

    public function shortCommitHashProvider(): array
    {
        return [
            [$this->createVersion(self::STABLE_VERSION), '51e867c'],
            [$this->createVersion(self::STABLE_VERSION_WITH_V), '93d39f1'],
            [$this->createVersion(self::DEV_VERSION), 'f6e77da'],
            [$this->createVersion(self::REPLACE_VERSION), 'aaabbbc'],
        ];
    }

    /**
     * @param string[] $fixture
     */
    private function createVersion(array $fixture): Version
    {
        return new Version('test/package', $fixture[0], $fixture[1]);
    }
}
