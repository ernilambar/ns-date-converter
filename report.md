# Security Review: NS Date Converter (v2.0.0)

## Summary

Reviewed the full plugin (`ns-date-converter.php`, `app/Core/Bootstrap.php`, `app/Utils/Helper.php`, `templates/converter.php`) plus the bundled `ernilambar/nepali-date` library. Attack surface is minimal: **one shortcode**, no AJAX handlers, no REST endpoints, no database queries, no file uploads, no `unserialize()`, no option writes, no redirects, no privilege-affecting calls. All user input (`$_POST['np_year']`, `np_month`, `np_day`, `en_year`, `en_month`, `en_day`) is passed through `absint()` before use, and all dynamic output goes through `esc_html()` / `esc_attr()`. The underlying date library validates ranges before converting, so malformed input degrades gracefully rather than erroring.

Overall risk posture: **Low**. No confirmed exploitable vulnerabilities. Two informational hardening notes below.

## Findings

### Informational (0.0) — Missing `ABSPATH` guard in non-entry PHP files
**Location:** `app/Core/Bootstrap.php`, `app/Utils/Helper.php`, `templates/converter.php`
**Vulnerability:** Direct file access prevention

**Details:** Only `ns-date-converter.php` checks `defined( 'ABSPATH' )`. The other three files have no such guard. If the web server is misconfigured to execute PHP directly from `wp-content/plugins/ns-date-converter/...` (not the WordPress default — WP core is not loaded in that request), requesting `templates/converter.php` directly would fatal-error immediately on the first undefined function call (`wp_verify_nonce`), since WordPress is not bootstrapped. This produces a PHP fatal error / stack trace disclosure at most (path disclosure), not code execution or data access.

**Why this is not currently exploitable:** No production WordPress deployment executes plugin files outside `wp-load.php` bootstrap by default; this requires server misconfiguration to reach at all, and even then yields only an error page, not attacker-controlled behavior.

**Remediation:** Add the standard guard to each file for defense-in-depth, matching WordPress plugin conventions:
```php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
```

### Informational (0.0) — Nonce read without `isset()` check
**Location:** `templates/converter.php:25`
**Vulnerability:** PHP notice / minor robustness issue (not a security vulnerability)

**Vulnerable Code:**
```php
if ( isset( $_POST['frm_submitted'] ) && 1 === absint( $_POST['frm_submitted'] ) ) {
    if ( wp_verify_nonce( wp_unslash( $_POST['ndc_nonce'] ), 'ns_date_converter' ) ) {
```

**Details:** `$_POST['ndc_nonce']` is read and passed to `wp_unslash()` without first checking `isset()`. If a request sends `frm_submitted=1` but omits `ndc_nonce` entirely, this triggers a PHP warning (`Undefined array key`) on PHP 8+. `wp_verify_nonce( null, ... )` then correctly returns `false`, so the security behavior (rejecting the unverified submission) is unaffected — this is a code-quality/robustness issue, not an exploitable gap.

**Remediation:**
```php
if ( isset( $_POST['ndc_nonce'] ) && wp_verify_nonce( wp_unslash( $_POST['ndc_nonce'] ), 'ns_date_converter' ) ) {
```

## Non-issues considered and ruled out

| Area | Why it's not a finding |
|---|---|
| CSRF / missing nonce impact | Nonce **is** present and verified. Even if it weren't, the form only performs a stateless date calculation with no DB write, option change, or privileged action — no CIA impact, so absence would not be a CSRF vulnerability per the CIA-triad test. |
| XSS via date fields | All six date inputs are coerced with `absint()` before storage/use/output; `esc_html()`/`esc_attr()` wrap all output in `Helper::render_select_dropdown()` and the results template. No raw `$_POST` value ever reaches output. |
| SQL Injection | Plugin makes zero database queries (`$wpdb` is not used anywhere). |
| Out-of-range date values (e.g. `np_year=999999999`) | `NepaliDate::convertAdToBs()` / `convertBsToAd()` call `validateDate()` internally and return an empty array for invalid dates; the template checks `is_array( $new_date ) && ! empty( $new_date )` before use, so invalid input silently degrades to "no result" rather than erroring. |
| Object injection | No `unserialize()` / `maybe_unserialize()` calls anywhere in the plugin. |
| Privilege escalation / capability checks | No `wp_set_current_user()`, `set_role()`, `add_cap()`, or any admin-side settings/AJAX/REST code exists — shortcode output is the plugin's only feature. |
| Third-party updater (`Nilambar\Gitvise\Updater`) | Initialized with a hardcoded repo string (`'ernilambar/ns-date-converter'`), not user input. Out of scope for this plugin's own attack surface; not reviewed further here. |

## Summary Table
| # | Severity | CVSS | WP-PR | Title | Location |
|---|----------|------|-------|-------|----------|
| 1 | Informational | 0.0 | N/A | Missing `ABSPATH` guard in non-entry files | `app/Core/Bootstrap.php`, `app/Utils/Helper.php`, `templates/converter.php` |
| 2 | Informational | 0.0 | N/A | Nonce field read without `isset()` check | `templates/converter.php:25` |
