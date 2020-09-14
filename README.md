# jean85/pretty-package-versions

![PHP Version](https://img.shields.io/badge/php-%5E7.0%7C%5E8.0-blue)
[![Stable release][Last stable image]][Packagist link]
[![Unstable release][Last unstable image]][Packagist link]

[![Build status](https://img.shields.io/github/workflow/status/Jean85/pretty-package-versions/Tests)](https://github.com/Jean85/pretty-package-versions/actions)
[![Codecov](https://codecov.io/gh/Jean85/pretty-package-versions/branch/master/graph/badge.svg)](https://codecov.io/gh/Jean85/pretty-package-versions)

A small, independent wrapper to get pretty versions strings of your dependencies.

## Installation
*It's suggested to use this package with a constraint of `^1.5 || ^2.0`, to obtain all the functionalities and guarantee future compatibility with Composer 2.

To install, use Composer:

 * from CLI: `composer require 'jean85/pretty-package-versions:^1.5 || ^2.0'`
 * or, directly in your `composer.json`:

```json
{
    "require": {
        "jean85/pretty-package-versions": "^1.5 || ^2.0"
    }
}
```
## Compatibility
This package was born as a thin wrapper for [ocramius/package-versions](https://packagist.org/packages/ocramius/package-versions); with the advent of Composer 2, this is no longer needed, since we can use directly `Composer\InstalledVersions`. This led to this version compatibility chart:

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

### Since 1.5
Since the 1.5 release, there are two additional methods available:

 * `PrettyVersions::getRootPackageName` returns the package name of the current (root) project, so basically the `name` property value in your `composer.json`; it is a compatibility layer to be used in place of `PackageVersions\Versions::ROOT_PACKAGE_NAME`, which would be a transient dependency and it's not guaranteed to be present
 * `PrettyVersions::getRootPackageVersion`, which is a shortcut to `PrettyVersions::getVersion(PrettyVersions::getRootPackageName())`

[Last stable image]: https://poser.pugx.org/Jean85/pretty-package-versions/version.svg
[Last unstable image]: https://poser.pugx.org/Jean85/pretty-package-versions/v/unstable.svg
[Packagist link]: https://packagist.org/packages/Jean85/pretty-package-versions
