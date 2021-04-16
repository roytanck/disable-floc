=== Disable FLoC ===
Contributors: roytanck
Tags: google, floc, cohorts, privacy, tracking
Requires at least: 5.0
Tested up to: 5.7
Requires PHP: 5.6
Stable tag: 1.1
License: GPLv3

Disables Google's FLoC tracking for your website's visitors by adding a 'Permissions-Policy' HTTP header.

== Description ==

This plugin adds an HTTP header to your WordPress website that disables Google's "Federated Learning of Cohorts" tracking. The following header will be added:

`Permissions-Policy: interest-cohort=()`

If an existing 'interest-cohort' value is found, the plugin will not change that value or add an additional one.

More information about FLoC can be found here:

[What is Federated Learning of Cohorts (FLoC)?](https://web.dev/floc/)
[Federated Learning of Cohorts (FLoC)](https://github.com/WICG/floc)
[Google’s FLoC Is a Terrible Idea](https://www.eff.org/deeplinks/2021/03/googles-floc-terrible-idea)
[Block FLoC With Duckduckgo](https://spreadprivacy.com/block-floc-with-duckduckgo/)
[Am I FLoCed?](https://www.eff.org/deeplinks/2021/04/am-i-floced-launch)


== Installation ==

This plugin has no settings. Simply install and activate it to exlude your website from FLoC tracking.


== Frequently Asked Questions ==

= I'm not using Chrome, why would I use this plugin? =

This plugin does not exclude you (as a user of the web) from FLoC tracking. It excludes your website, and thus protects your website's visitors. Many of them will probably use Chrome.

= How can I check if this plugin works? =

This plugin attempts to add an HTTP header. You can use your browser's Dev Tools to check whether it gets added properly.

* Visit any page on your site using the browser of your choice.
* Press F12, or right-click anywhere on the page and click "Inspect element".
* Switch to the network tab in the newly opened development tools pane.
* Turn on recording (if it's not already active), and reload the page.
* You'll see a number of requests appear as a list. The top one is usually the page itself.
* Click that line to open up its properties.
* Look for the header under "Response headers".

I've also set up an [online FLoC header checker](https://tanck.nl/floc-check). Simply enter your website's homepage URL to see of the header is present.

= I don't see the header, what could be wrong? =

HTTP headers can get added and/or removed on many levels in the server stack.

* By WordPress itself (which is what this plugin attempts).
* By the web server (NGINX, Apache, etc).
* By caching layers, proxies, etc.

Please note that there's a known issue with many page caching plugins where the 'hook' that this plugin uses does not work. This is a fundamental issue in WordPress and not something that's easy to work around. If the header does not get added by this plugin, your best option is to see if it can be added on one of the other levels. Or ask your system administrator to do this for you.


== Changelog ==

= 1.1 =
* Code refactor, including some fixes
* Added an FAQ to the readme.txt

= 1.0 =
* Initial release
