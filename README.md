# jean85/pretty-package-versions

[![PHP Version](https://img.shields.io/badge/php-%5E7.0-blue.svg)](https://img.shields.io/badge/php-%5E7.0-blue.svg)
[![Stable release][Last stable image]][Packagist link]
[![Unstable release][Last unstable image]][Packagist link]
[![composer.lock available](https://poser.pugx.org/jean85/pretty-package-versions/composerlock)](https://packagist.org/packages/jean85/pretty-package-versions)

[![Build status][Master build image]][Master build link]
[![Codecov](https://codecov.io/gh/Jean85/pretty-package-versions/branch/master/graph/badge.svg)](https://codecov.io/gh/Jean85/pretty-package-versions)
[![SL Insight][SL Insight image]][SL Insight link]

A small, indipendent wrapper to get pretty versions strings of your dependencies.

## Installation
To use this package, use Composer:

 * from CLI: `composer require jean85/pretty-package-versions`
 * or, directly in your `composer.json`:

```json
{
    "require": {
        "jean85/pretty-package-versions": "^1.2"
    }
}
```
## Compatibility
This packages was born as a thin wrapper for [ocramius/package-versions](https://packagist.org/packages/ocramius/package-versions); with the advent of Composer 2, this is no longer needed, since we can use directly `Composer\InstalledVersions`. This led to this version compatibility chart:

|`pretty-package-versions`| Composer         | Dependency used
|-------------------------|------------------|-----------------|
| Up to 1.2               | 1.x only         | `ocramius/package-versions`
| 1.3                     | Both 1.x and 2.x | `composer/package-versions-deprecated`, fork of `ocramius/package-versions` |
| 1.4                     | 2.x only         | None            |
| 1.5+                    | Both 1.x and 2.x | `composer/package-versions-deprecated`, fork of `ocramius/package-versions` |
| 2.0 (unreleased)        | 2.x only         | None            |

This means that, with this package, you can obtain pretty versions without tying your user to any specific Composer version, with a smooth upgrade path. The release of 1.4 was reverted due to some discussion in [#21](https://github.com/Jean85/pretty-package-versions/issues/21) and related issues.

## Usage
This package should be used with a single class, `Jean85\PrettyVersions`: it provides a single method that returns a `Jean85\Version` object for the requested package, like in this example:

```php
use Jean85\PrettyVersions;

$version = PrettyVersions::getVersion('phpunit/phpunit');
$version->getPrettyVersion(); // '6.0.0'
$version->getShortVersion(); // '6.0.0'
$version->getVersionWithShortCommit(); // '6.0.0@fa5711'

$version = PrettyVersions::getVersion('roave/security-advisories');
$version->getPrettyVersion(); // 'dev-master@7cd88c8'
$version->getShortVersion(); // 'dev-master'
$version->getVersionWithShortCommit(); // 'dev-master@7cd88c8'
```

The `Version` class has also a `__toString()` method implemented, so it can be easily cast to a string; the result would be the same as calling the `getPrettyVersion()` method.

### Available methods

The `Jean85\Version` class has these public methods available:

 * `getPrettyVersion(): string`: if the requested package is a tagged version, it will return just the short version; if not, it will output the same result as `getVersionWithShortCommit()`

 * `getShortVersion(): string`: it will return just the version of the package (i.e. `6.0.0`, `v.1.7.0`, `99999-dev` etc...)

 * `getVersionWithShortCommit(): string`: it will return the version of the package, followed by the short version of the commit hash (i.e. `6.0.0@fa5711`)

 * `getPackageName(): string` will return the original package name

 * `getFullVersion(): string` will return the same value as `PackageVersions\Versions::getVersion()` 

 * `getCommitHash(): string` will return the full commit hash 

 * `getShortCommitHash(): string` will return the short commit hash (i.e. `fa5711`)

 * `__toString(): string` will return the same as `getPrettyVersion()`

[Last stable image]: https://poser.pugx.org/Jean85/pretty-package-versions/version.svg
[Last unstable image]: https://poser.pugx.org/Jean85/pretty-package-versions/v/unstable.svg
[Master build image]: https://travis-ci.org/Jean85/pretty-package-versions.svg
[SL Insight image]: https://insight.sensiolabs.com/projects/275dfe5b-5b16-42df-949b-a7db85a8fe4e/mini.png

[Packagist link]: https://packagist.org/packages/Jean85/pretty-package-versions
[Master build link]: https://travis-ci.org/Jean85/pretty-package-versions
[SL Insight link]: https://insight.sensiolabs.com/projects/275dfe5b-5b16-42df-949b-a7db85a8fe4e
