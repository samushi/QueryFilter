# Changelog

All notable changes to `QueryFilter` will be documented in this file.

## [v2.2.0] - 2024-12-15

### Added
- **Manual Data Injection**: Filters can now be used outside HTTP request contexts (Jobs, Commands, Tests)
  - Added optional constructor parameter to inject data manually: `new StatusFilter(['status' => 'active'])`
  - Filters automatically detect data source (manual data or HTTP request)
  - Full backward compatibility - existing code works without changes
- **Comprehensive Documentation**: Added "Using Filters Outside HTTP Requests" section with examples:
  - Queue Jobs examples
  - Console Commands examples
  - Unit Tests examples
  - Scheduled Tasks examples
  - Mixed usage (HTTP + Manual data)

### Changed
- Enhanced `Filter` class with optional constructor for data injection
- Added `getValueSource()` helper method for clean value retrieval
- Updated `getValue()` and `handle()` methods to support both HTTP and manual data sources
- Improved documentation with real-world use cases

### Technical Details
- Constructor accepts optional `?array $data = null` parameter
- Manual data takes precedence over HTTP request parameters
- Filter name must match array key when using manual data injection
- Zero breaking changes - 100% backward compatible

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
