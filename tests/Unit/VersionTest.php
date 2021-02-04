<?php

namespace Tests\Unit;

use Jean85\Version;
use PHPUnit\Framework\TestCase;

class VersionTest extends TestCase
{
    const STABLE_VERSION = '1.1.2@51e867c70f0799790b3e82276875414ce13daaca';
    const STABLE_VERSION_WITH_V = 'v1.7.0@93d39f1f7f9326d746203c7c056f300f7f126073';
    const DEV_VERSION = '9999999-dev@f6e77da35a8420cc1923c3ad3f13b1a191ff0311';
    const REPLACE_VERSION = 'self.version@aaabbbcccddd';

    public function testGetPackageName()
    {
        $version = new Version('vendor/package', 'v1.0@51e867c70f0799790b3e82276875414ce13daaca');

        $this->assertSame('vendor/package', $version->getPackageName());
    }

    /**
     * @dataProvider fullVersionProvider
     */
    public function testGetFullVersion(string $originalVersion)
    {
        $version = new Version('vendor/package', $originalVersion);

        $this->assertSame($originalVersion, $version->getFullVersion());
    }

    public function fullVersionProvider(): array
    {
        return [
            [self::STABLE_VERSION],
            [self::STABLE_VERSION_WITH_V],
            [self::DEV_VERSION],
            [self::REPLACE_VERSION],
        ];
    }

    /**
     * @dataProvider prettyVersionProvider
     */
    public function testGetPrettyVersion(string $originalVersion, string $expectedVersion)
    {
        $version = new Version('vendor/package', $originalVersion);

        $this->assertSame($expectedVersion, $version->getPrettyVersion());
    }

    /**
     * @dataProvider prettyVersionProvider
     */
    public function testToString(string $originalVersion, string $expectedVersion)
    {
        $version = new Version('vendor/package', $originalVersion);

        $this->assertSame($expectedVersion, (string)$version);
    }

    public function prettyVersionProvider(): array
    {
        return [
            [self::STABLE_VERSION, '1.1.2'],
            [self::STABLE_VERSION_WITH_V, 'v1.7.0'],
            [self::DEV_VERSION, '9999999-dev@f6e77da'],
            [self::REPLACE_VERSION, 'self.version@aaabbbc'],
        ];
    }

    /**
     * @dataProvider versionWithShortCommitProvider
     */
    public function testGetVersionWithShortCommit(string $originalVersion, string $expectedVersion)
    {
        $version = new Version('vendor/package', $originalVersion);

        $this->assertSame($expectedVersion, $version->getVersionWithShortCommit());
        $this->assertSame($version->getVersionWithShortCommit(), $version->getVersionWithShortReference(), 'FC layer is failing');
    }

    public function versionWithShortCommitProvider(): array
    {
        return [
            [self::STABLE_VERSION, '1.1.2@51e867c'],
            [self::STABLE_VERSION_WITH_V, 'v1.7.0@93d39f1'],
            [self::DEV_VERSION, '9999999-dev@f6e77da'],
            [self::REPLACE_VERSION, 'self.version@aaabbbc'],
        ];
    }

    /**
     * @dataProvider shortVersionProvider
     */
    public function testGetShortVersion(string $originalVersion, string $expectedVersion)
    {
        $version = new Version('vendor/package', $originalVersion);

        $this->assertSame($expectedVersion, $version->getShortVersion());
    }

    public function shortVersionProvider(): array
    {
        return [
            [self::STABLE_VERSION, '1.1.2'],
            [self::STABLE_VERSION_WITH_V, 'v1.7.0'],
            [self::DEV_VERSION, '9999999-dev'],
            [self::REPLACE_VERSION, 'self.version'],
        ];
    }

    /**
     * @dataProvider commitHashProvider
     */
    public function testGetCommitHash(string $originalVersion, string $expectedHash)
    {
        $version = new Version('vendor/package', $originalVersion);

        $this->assertSame($expectedHash, $version->getCommitHash());
        $this->assertSame($version->getCommitHash(), $version->getReference(), 'FC layer is failing');
    }

    public function commitHashProvider(): array
    {
        return [
            [self::STABLE_VERSION, '51e867c70f0799790b3e82276875414ce13daaca'],
            [self::STABLE_VERSION_WITH_V, '93d39f1f7f9326d746203c7c056f300f7f126073'],
            [self::DEV_VERSION, 'f6e77da35a8420cc1923c3ad3f13b1a191ff0311'],
            [self::REPLACE_VERSION, 'aaabbbcccddd'],
        ];
    }

    /**
     * @dataProvider shortCommitHashProvider
     */
    public function testGetShortCommitHash(string $originalVersion, string $expectedHash)
    {
        $version = new Version('vendor/package', $originalVersion);

        $this->assertSame($expectedHash, $version->getShortCommitHash());
        $this->assertSame($version->getShortCommitHash(), $version->getShortReference(), 'FC layer is failing');
    }

    public function shortCommitHashProvider(): array
    {
        return [
            [self::STABLE_VERSION, '51e867c'],
            [self::STABLE_VERSION_WITH_V, '93d39f1'],
            [self::DEV_VERSION, 'f6e77da'],
            [self::REPLACE_VERSION, 'aaabbbc'],
        ];
    }
}
