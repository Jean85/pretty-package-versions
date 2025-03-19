<?php

declare(strict_types=1);

namespace Tests\Unit;

use Jean85\Version;
use PHPUnit\Framework\TestCase;

class VersionTest extends TestCase
{
    private const STABLE_VERSION = ['1.1.2', '51e867c70f0799790b3e82276875414ce13daaca'];
    private const STABLE_VERSION_WITH_V = ['v1.7.0', '93d39f1f7f9326d746203c7c056f300f7f126073'];
    private const DEV_VERSION = ['9999999-dev', 'f6e77da35a8420cc1923c3ad3f13b1a191ff0311'];
    private const PRE_RELEASE_VERSION = ['7.0.0-RC1', 'f6e77da35a8420cc1923c3ad3f13b1a191ff0311'];
    private const REPLACE_VERSION = ['self.version', 'aaabbbcccddd'];

    public function testGetPackageName(): void
    {
        $version = new Version('vendor/package', 'v1.0', '51e867c70f0799790b3e82276875414ce13daaca');

        $this->assertSame('vendor/package', $version->getPackageName());
    }

    /**
     * @dataProvider fullVersionProvider
     */
    public function testGetFullVersion(string $prettyVersion, string $reference): void
    {
        $version = new Version('vendor/package', $prettyVersion, $reference);

        $this->assertSame($prettyVersion . '@' . $reference, $version->getFullVersion());
    }

    /**
     * @return array{0: string, 1: string}[]
     */
    public function fullVersionProvider(): array
    {
        return [
            self::STABLE_VERSION,
            self::STABLE_VERSION_WITH_V,
            self::DEV_VERSION,
            self::PRE_RELEASE_VERSION,
            self::REPLACE_VERSION,
        ];
    }

    /**
     * @dataProvider prettyVersionProvider
     */
    public function testGetPrettyVersion(Version $version, string $expectedVersion): void
    {
        $this->assertSame($expectedVersion, $version->getPrettyVersion());
    }

    /**
     * @dataProvider prettyVersionProvider
     */
    public function testToString(Version $version, string $expectedVersion): void
    {
        $this->assertSame($expectedVersion, (string) $version);
    }

    /**
     * @return array{0: Version, 1: string}[]
     */
    public function prettyVersionProvider(): array
    {
        return [
            [$this->createVersion(self::STABLE_VERSION), '1.1.2'],
            [$this->createVersion(self::STABLE_VERSION_WITH_V), 'v1.7.0'],
            [$this->createVersion(self::DEV_VERSION), '9999999-dev@f6e77da'],
            [$this->createVersion(self::PRE_RELEASE_VERSION), '7.0.0-RC1'],
            [$this->createVersion(self::REPLACE_VERSION), 'self.version@aaabbbc'],
        ];
    }

    /**
     * @dataProvider versionWithShortReferenceProvider
     */
    public function testGetVersionWithShortReference(Version $version, string $expectedVersion): void
    {
        $this->assertSame($expectedVersion, $version->getVersionWithShortReference());
    }

    /**
     * @dataProvider versionWithShortReferenceProvider
     */
    public function testDeprecatedGetters(Version $version): void
    {
        $this->assertSame($version->getReference(), $version->getCommitHash());
        $this->assertSame($version->getShortReference(), $version->getShortCommitHash());
        $this->assertSame($version->getVersionWithShortReference(), $version->getVersionWithShortCommit());
    }

    /**
     * @return array{0: Version, 1: string}[]
     */
    public function versionWithShortReferenceProvider(): array
    {
        return [
            [$this->createVersion(self::STABLE_VERSION), '1.1.2@51e867c'],
            [$this->createVersion(self::STABLE_VERSION_WITH_V), 'v1.7.0@93d39f1'],
            [$this->createVersion(self::PRE_RELEASE_VERSION), '7.0.0-RC1@f6e77da'],
            [$this->createVersion(self::DEV_VERSION), '9999999-dev@f6e77da'],
            [$this->createVersion(self::REPLACE_VERSION), 'self.version@aaabbbc'],
        ];
    }

    /**
     * @dataProvider shortVersionProvider
     */
    public function testGetShortVersion(Version $version, string $expectedVersion): void
    {
        $this->assertSame($expectedVersion, $version->getShortVersion());
    }

    /**
     * @return array{0: Version, 1: string}[]
     */
    public function shortVersionProvider(): array
    {
        return [
            [$this->createVersion(self::STABLE_VERSION), '1.1.2'],
            [$this->createVersion(self::STABLE_VERSION_WITH_V), 'v1.7.0'],
            [$this->createVersion(self::DEV_VERSION), '9999999-dev'],
            [$this->createVersion(self::PRE_RELEASE_VERSION), '7.0.0-RC1'],
            [$this->createVersion(self::REPLACE_VERSION), 'self.version'],
        ];
    }

    /**
     * @dataProvider referenceHashProvider
     */
    public function testGetReference(Version $version, string $expectedReference): void
    {
        $this->assertSame($expectedReference, $version->getReference());
    }

    /**
     * @return array{0: Version, 1: string}[]
     */
    public function referenceHashProvider(): array
    {
        return [
            [$this->createVersion(self::STABLE_VERSION), '51e867c70f0799790b3e82276875414ce13daaca'],
            [$this->createVersion(self::STABLE_VERSION_WITH_V), '93d39f1f7f9326d746203c7c056f300f7f126073'],
            [$this->createVersion(self::DEV_VERSION), 'f6e77da35a8420cc1923c3ad3f13b1a191ff0311'],
            [$this->createVersion(self::PRE_RELEASE_VERSION), 'f6e77da35a8420cc1923c3ad3f13b1a191ff0311'],
            [$this->createVersion(self::REPLACE_VERSION), 'aaabbbcccddd'],
        ];
    }

    /**
     * @dataProvider shortReferenceHashProvider
     */
    public function testGetShortReference(Version $version, string $expectedHash): void
    {
        $this->assertSame($expectedHash, $version->getShortReference());
    }

    public function testGetShortReferenceShouldNotTruncateMissingReference(): void
    {
        $version = new Version('test/package', '1.0.0');

        $this->assertSame('{no reference}', $version->getShortReference());
    }

    /**
     * @return array{0: Version, 1: string}[]
     */
    public function shortReferenceHashProvider(): array
    {
        return [
            [$this->createVersion(self::STABLE_VERSION), '51e867c'],
            [$this->createVersion(self::STABLE_VERSION_WITH_V), '93d39f1'],
            [$this->createVersion(self::DEV_VERSION), 'f6e77da'],
            [$this->createVersion(self::REPLACE_VERSION), 'aaabbbc'],
        ];
    }

    public function testCreateWithNullReference(): void
    {
        $version = new Version('test/package', '1.0.0', null);

        $this->assertSame('{no reference}', $version->getReference());
    }

    public function testCreateWithNoReference(): void
    {
        $version = new Version('test/package', '1.0.0');

        $this->assertSame('{no reference}', $version->getReference());
    }

    /**
     * @dataProvider taggedVersionProvider
     */
    public function testRegressionDetectTaggedVersion(string $version): void
    {
        $version = new Version('test/package', $version, 'abcdef');

        $this->assertSame($version->getPrettyVersion(), $version->getShortVersion(), 'Version is not detected as tagged as expected');
    }

    /**
     * @return array{string}[]
     */
    public function taggedVersionProvider(): array
    {
        return [
            ['7.0.0-alpha-1'],
            ['7.0.0-alpha.1'],
            ['7.0.0-alpha1'],
            ['7.0.0-ALPHA1'],
            ['7.0.0-beta1'],
            ['7.0.0-RC1'],
            ['7.0.0-rc1'],
            ['1.1.2'],
            ['v1.7.0'],
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
