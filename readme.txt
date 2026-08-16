=== NS Date Converter ===
Contributors: nilambar
Tags: date, nepali, converter, bikram-sambat, bs, ad, shortcode
Requires at least: 7.0
Tested up to: 7.1
Requires PHP: 8.2
Stable tag: 2.0.0
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Provides a shortcode to convert dates between Nepali (Bikram Sambat) and English (Gregorian) calendars.

== Description ==

NS Date Converter adds a simple shortcode `[ns_date_converter]` to display a date conversion form. Users can convert dates between Nepali (Bikram Sambat) and English (Gregorian/AD) calendars.

**Features:**
* Convert Nepali (BS) to English (AD) dates
* Convert English (AD) to Nepali (BS) dates
* Displays formatted date details for both calendars
* Uses shortcode for easy placement anywhere
* No external dependencies or API calls

== Installation ==

1. Upload the plugin files to `/wp-content/plugins/ns-date-converter`, or install through the WordPress plugins screen.
2. Activate the plugin through the "Plugins" screen.
3. Use the shortcode `[ns_date_converter]` in any post, page, or widget.

== Frequently Asked Questions ==

= How do I use the converter? =
Add `[ns_date_converter]` to any post or page. The form lets you select a date in either calendar and convert it.

= Does this require an API key? =
No. All conversion happens locally using the bundled Nepali Date library.

== Changelog ==

= 2.0.0 - 2026-08-16 =
* Restructure folders
* WP 7.1 compatibility

= 1.0.10 =
* Updated plugin updater to use GitHub releases
* Removed unused AJAX endpoint and asset loading
* Code cleanup and lint fixes

= 1.0.9 =
* Initial release on WordPress.org

== Upgrade Notice ==

= 1.0.10 =
Minor maintenance update. No functional changes.
