# Changelog

This changelog documents the two most recent published releases of `local_helpdesk`, based on the Git differences between their release tags. Changes made after tag `3.0.1` are not included.

## [3.0.1] - 2026-10-23

### Fixed
- Corrected ticket ownership during ticket creation: staff members with ticket-management permission can assign the selected user, while tickets without an eligible user selection are assigned to the currently logged-in user.
- Initialized notification subject and message templates from the configured event before performing placeholder substitutions, including when the notification sender is reused.
- Fixed detection of the `{[to.password]}` notification placeholder when it occurs at the beginning of a message by using an explicit `strpos(...) !== false` comparison.

### Changed
- Replaced `core_text::strlen()` with native `strlen()` in AI prompt-length conditions and MCP write-tool title validation.
- Rebuilt the compiled AMD assets for the course and user selection dialogs.
- Standardized the quoting of English and Brazilian Portuguese language strings, updated file headers, and cleaned up Mustache template documentation.

### Tests
- Added `tests/send_message_test.php` to cover notification template initialization and reuse of the same sender with updated templates.

**Full comparison:** [3.0.0...3.0.1](https://github.com/EduardoKrausME/moodle-local_helpdesk/compare/3.0.0...3.0.1)

## [3.0.0] - 2026-10-19

### Added
- Added optional Kopere Dashboard integration for Helpdesk support staff, including a dedicated menu definition (`classes/menu.php`) and a provider exposing the plugin's existing capabilities for centralized permission management (`classes/capabilities_provider.php`).
- Added `classes/output/page.php` to render eligible staff pages inside the Kopere Dashboard layout while retaining the native Moodle layout when the Dashboard integration is unavailable or the user does not have the required permissions.
- Added a reusable Kopere Dashboard card template (`templates/dashboard_card.mustache`) and accompanying interface styling.
- Added a dismissible MCP integration notice for site administrators when `local_mcp` is not installed. The dismissal is stored as a user preference and is protected by a POST request and Moodle session-key validation.
- Added automated tests for the Kopere Dashboard integration.

### Changed
- Adapted ticket listing and details, categories, knowledge-base views, and related editing forms to use the new layout integration.
- Reworked Helpdesk navigation so learners continue to see a regular Moodle Helpdesk link, while support staff use the Kopere Dashboard menu. Staff access and additional menu entries remain capability-dependent.
- Allowed staff with `local/helpdesk:ticketmanage` to access the ticket listing even when they do not separately have `local/helpdesk:view`.
- Updated the README reference to the Moodle MCP documentation site.

### Release maintenance
- Added a Git-ref-scoped concurrency configuration to the automatic release workflow to avoid cancelling an in-progress publication.

**Full comparison:** [2.5.4...3.0.0](https://github.com/EduardoKrausME/moodle-local_helpdesk/compare/2.5.4...3.0.0)
