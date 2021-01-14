# Changes in jean85/pretty-package-versions

All notable changes of the `jean85/pretty-package-versions` package are documented in this file using the 
[Keep a CHANGELOG](http://keepachangelog.com/) principles.

## [2.0.0] - 2021-01-14
This release is aimed to become a bridge for native Composer 2 support. The BC breaks are minimal; if you're using it in a library, you're encouraged to require it  with `^1.5 || ^2.0`, so that your end users will not be constrained to use a specific Composer version. 

### Added
 * `Version` methods added: `getReference`, `getShortReference`, `getVersionWithShortReference` (see table below)
### Changed
 * Use Composer 2 API directly to retrieve versions
 * `Version` methods deprecated; this is a simple rename (`commit` to `reference`), to better reflect the meaning of Composer API data; the old methods are preserved but deprecated to reduce breaking changes:

| New method                                | Old, deprecated method                 |
|-------------------------------------------|----------------------------------------|
| `Version::getReference()`                 | `Version::getCommitHash()`             | 
| `Version::getShortReference()`            | `Version::getShortCommitHash()`        | 
| `Version::getVersionWithShortReference()` | `Version::getVersionWithShortCommit()` |

### Removed
 * Drop PHP 7.0 support
 * Drop Composer 1 support
 * Drop dependencies
 * [BC BREAK] Constant `PrettyVersions::SHORT_COMMIT_LENGTH` removed
 * [BC BREAK] Constant `Version::SHORT_COMMIT_LENGTH` made private
 * [BC BREAK] `Version` constructor changed arguments: second argument `string $version` has been split into `string $prettyVersion, string $reference`

## [1.5.1] - 2020-09-14
### Added
 * PHP 8 support (#28)

## [1.5] - 2020-06-23
This release is intended to change the future release plan of this package. Please require the package with `^1.5 || ^2.0` to ensure full functionalities and future Composer 2 compatibility.

### Added
 * Add `PrettyVersions::getRootPackageName` as a compatibility layer to be used in place of `PackageVersions\Versions::ROOT_PACKAGE_NAME`, which would be a transient dependency (#23)
 * Add `PrettyVersions::getRootPackageVersion`, a shortcut to `PrettyVersions::getVersion(PrettyVersions::getRootPackageName())` (#23)

### Changed
 * Roll back to use `composer/package-versions-deprecated` as in 1.3 (see #21 & #22)

## [1.4] - 2020-04-28
### Removed
 * Drop support for Composer 1
 * Drop dependency on any package
 * Drop Scrutinizer, use Codecov for test coverage

## [1.3] - 2020-04-24
### Changed
 * Switched dependency from `ocramius/package-versions` to its fork `composer/package-versions-deprecated`, to ensure compatibility with both PHP 7.* and Composer 2 (see #13, thanks @dereuromark and @seldaek)

## [1.2] - 2018-06-13
### Added
 * Add `Version::__getShortCommitHash()` method (see #8, thanks @emodric)

## [1.1] - 2018-01-21
### Added
 * Add `Version::__toString()` method (see #5)

## [1.0.3] - 2017-11-30
### Changed
 * Require at least `ocramius/package-versions` 1.2 to fix root package version (see #3)
### Known issues
 * Use this package with Composer >= 1.5.3 to fix root package version when in version-branch (see #4)

## [1.0.2] - 2017-09-06
### Added
 * Add PHP 7.2 to the build matrix for official support
### Changed
 * Require at least `ocramius/package-versions` 1.1.3 to avoid issues when removing the package (see [this issue](https://github.com/Ocramius/PackageVersions/issues/41))

## [1.0.1] - 2017-07-06
### Changed
 * Make the package lightweight thanks to the `.gitattributes` file (#1)

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
