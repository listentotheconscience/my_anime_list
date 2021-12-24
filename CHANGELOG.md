# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.13.1] - 2021-12-24
### Added
- Routes for followers
### Changed
- CHANGELOG.md type errors

## [0.13.0] - 2021-12-24
### Added
- Followers! Cheers!

### Changed
- Some bug fixes

## [0.12.0] - 2021-12-21
### Added
- S3 supporting
- TestController as dev tool

### Changed
- Architecture of project. From now all controllers divided by Anime controllers and Manga Controllers
- All controllers use CRUDL (create, read, update, delete, list)

### Removed
- MangakaController. It was an error
- Supporting local storage. Only AWS. Only hardcore :D
