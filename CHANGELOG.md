# Changes in jean85/pretty-package-versions

All notable changes of the `jean85/pretty-package-versions` package are documented in this file using the 
[Keep a CHANGELOG](http://keepachangelog.com/) principles.

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
