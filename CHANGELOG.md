# Changes in jean85/pretty-package-versions

All notable changes of the `jean85/pretty-package-versions` package are documented in this file using the 
[Keep a CHANGELOG](http://keepachangelog.com/) principles.

## [1.4.1] - TBA
### SMALL BREAKING CHANGE
 * Small change in the `Jean85\PrettyVersions::getVersion` signature:
```diff
-    public static function getVersion(string $packageName): Jean85\Version
+    public static function getVersion(string $packageName): Jean85\VersionInterface
```
 This could lead to some breakage in static analysis, but it shouldn't break runtime, since the exposed API is the same. Change of behavior is only possible if you previosly did a `instaceof Version`. 
### Added
 * Added `Jean85\VersionInterface`, with the same API of `Jean85\Version`
 * Added `Jean85\ReplacedPackageVersion` and `Jean85\ProvidedPackageVersion`, both implementing `Jean85\Version`
### Fixed
 * Fixed bug when requesting a replaced or provided package

## [1.4] - 2020-04-28
### Removed
 * Drop support for Composer 1
 * Drop dependency on any package
 * Drop Scrutinizer, use Codecov for test coverage

## [1.3] - 2020-04-24
### Changed
 * Switched dependency from `ocramius/package-versions` to its fork `composer/package-versions-deprecated`, to ensure compatibility with both PHP 7.* and Composer 2 (see [#13](https://github.com/Jean85/pretty-package-versions/pull/13), thanks @dereuromark and @seldaek)

## [1.2] - 2018-06-13
### Added
 * Add `Version::__getShortCommitHash()` method (see [#8](https://github.com/Jean85/pretty-package-versions/pull/8), thanks @emodric)

## [1.1] - 2018-01-21
### Added
 * Add `Version::__toString()` method (see [#5](https://github.com/Jean85/pretty-package-versions/pull/5))

## [1.0.3] - 2017-11-30
### Changed
 * Require at least `ocramius/package-versions` 1.2 to fix root package version (see [#3](https://github.com/Jean85/pretty-package-versions/issues/3))
### Known issues
 * Use this package with Composer >= 1.5.3 to fix root package version when in version-branch (see [#4](https://github.com/Jean85/pretty-package-versions/issues/4))

## [1.0.2] - 2017-09-06
### Added
 * Add PHP 7.2 to the build matrix for official support
### Changed
 * Require at least `ocramius/package-versions` 1.1.3 to avoid issues when removing the package (see [this issue](https://github.com/Ocramius/PackageVersions/issues/41))

## [1.0.1] - 2017-07-06
### Changed
 * Make the package lightweight thanks to the `.gitattributes` file ([#1](https://github.com/Jean85/pretty-package-versions/pull/1))

## [1.0] - 2017-07-06
First release
### Changed
 * `Jean85\PrettyVersions` wraps the `PackageVersions\Versions` class and returns a `Jean85\Version` object
 * The `Jean85\Version` has these methods available:
    * `public function getPrettyVersion(): string`
    * `public function getFullVersion(): string`
    * `public function getVersionWithShortCommit(): string`
    * `public function getPackageName(): string`
    * `public function getShortVersion(): string`
    * `public function getCommitHash(): string`
