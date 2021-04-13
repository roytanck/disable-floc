=== FLoC off! ===
Contributors: roytanck
Tags: google, floc, cohorts, privacy, tracking
Requires at least: 5.0
Tested up to: 5.7
Requires PHP: 5.6
Stable tag: 1.0
License: GPLv3

Disables Google's FLoC tracking for your website's visitors by adding a 'Permissions-Policy' HTTP header.
 
== Description ==

This plugin adds a HTTP header to your WordPress website that disables Google's FLoC tracking. The following header will be added:

`Permissions-Policy: interest-cohort=()`

If an existing 'interest-cohort' value is found, the plugin will not change that value or add an additional one.

More information about FLoC can be found here:

[Google’s FLoC Is a Terrible Idea](https://www.eff.org/deeplinks/2021/03/googles-floc-terrible-idea)
[Block FLoC With Duckduckgo](https://spreadprivacy.com/block-floc-with-duckduckgo/)
[Am I FLoCed?](https://www.eff.org/deeplinks/2021/04/am-i-floced-launch)

== Installation ==

This plugin has no settings. Simply install and activate it to exlude your website from FLoC tracking.
 
== Changelog ==
 
= 1.0 =
* Initial release
