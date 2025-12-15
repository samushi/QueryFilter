# Changelog

All notable changes to `QueryFilter` will be documented in this file.

## [v2.1.0] - 2024-12-15

### Added
- **Array Support in `getValue()` Method**: The `getValue()` method now accepts an optional boolean parameter `$asArray` (default: `false`) to automatically convert values to arrays
  - Supports comma-separated values: `?status=active,pending,completed`
  - Supports array query parameters: `?status[]=active&status[]=pending`
  - Automatic whitespace trimming for comma-separated values
  - Backward compatible - default behavior remains unchanged
- **Comprehensive Documentation**: Complete rewrite of README.md with detailed examples and best practices
  - Added "Working with Arrays" section with real-world examples
  - Added "Advanced Usage" section with practical filter implementations
  - Added "Best Practices" section for developers
  - Added Table of Contents for easier navigation
  - Improved code examples throughout

### Changed
- Enhanced `getValue()` return type from `string` to `string|array` when using array mode
- Improved documentation structure with better organization and clearer examples

### Technical Details
- `getValue()` now intelligently detects array inputs from query parameters
- Automatic conversion between comma-separated strings and arrays
- Native array parameter support (e.g., `?param[]=value1&param[]=value2`)

## [v2.0] - Previous Release

### Added
- Initial stable release with core filtering functionality
- `whereLike` macro for searching across multiple columns
- `whereDateBetween` macro for date range filtering
- Pipeline-based filter system
- Model trait for direct filtering on Eloquent models

## [v1.0.6] - Previous Release

### Changed
- Minor improvements and bug fixes

## [v1.0.5] - Previous Release

### Changed
- Minor improvements and bug fixes

## [v1.0.4] - Previous Release

### Changed
- Minor improvements and bug fixes

## [v1.0.3] - Previous Release

### Added
- Initial public release
