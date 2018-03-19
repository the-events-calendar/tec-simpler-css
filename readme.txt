=== Tribe Simpler CSS ===
Contributors: brianjessee
Tags: css, wpmu, appearance, themes
Requires at least: 3.9
Tested up to: 4.6.1
Stable tag: 0.5
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=759905

A simple (mu-)plugin enabling custom CSS on WordPress and WordPress µ blogs.

== Description ==

This Simpler CSS mu-plugin allows WordPress µ hosts to enable users to add custom stylesheets to their blogs.

The plugin creates a new menu item under the Appearance menu in WordPress 2.7
that allows users to enter custom CSS code that will be injected into the
`<head>` section of their blog. The CSS is stored in the blog's options table
and is filtered through a standard PHP function before being outputted, preventing
the user from inserting malicious code into the header.

For non-WordPress µ blogs, this plugin provides an easy way to modify the appearance of installed
themes or plugins (such as Sociable) without modifying theme/plugin files that may change
with upgrades. No write access is required to any files for Simpler CSS to function, as it stores
its data in the database's options table — and that means theme/plugin upgrades won't impact
your custom CSS.

The custom CSS will only show when the theme has the necessary `wp_header()` function
in the `<head>` section, as most themes now do.

Props go to Jeremiah Orem who created the original Custom User CSS plugin on the directory.
I merely took that, contributed a thorough readme.txt, and fixed the code to add the menu item
under the Appearance menu.

== Installation ==
= For WordPress µ =
1. Upload the `simpler-css.php` file to the `/wp-content/mu-plugins/` directory. The other files
should not be uploaded, and the file cannot be in a subdirectory.
2. You're done! As a mu-plugin, Simpler CSS is automatically enabled for all blogs.
= For normal WordPress installations =
1. Upload the `simpler-css` directory to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

= Why isn't the code showing up on the blog? =
Remember that this plugin depends on standard WordPress hooks to operate. If the
active theme does not have `wp_header()` in its code, this plugin is ineffective.
*Remedy:* add the code `<?php wp_header(); ?>` to the theme files in the `<head>` section.

= Why can't I add JavaScript to the blog's code? =
This plugin will only operate for Cascading Style Sheets code. The custom CSS is escaped
and outputted within a set of `<style>` tags, preventing bots from abusing the functionality
to inject malicious code. Allowing users to inject JavaScript into the blog's header
is a security vulnerability, thus this plugin does not permit it.

= Why isn't my CSS showing as it should be? =
Check first of all to make sure that your custom CSS *does not* include the opening `<style type="text/css">`
and closing `</style>` HTML tags. These tags are outputted automatically, and including
them manually in your CSS code could lead to malfunctions.

== Screenshots ==
1. The menu item as it appears under the Appearance menu.
2. The options page, with CSS code.

== Changelog ==
= 0.6 =
* Updated deprecated function
* Connect nonce field into saving process

= 0.5 =
* Updated compatibility to 3.0-alpha (Subversion trunk version)
* Fixed `htmlspecialchars()` usage to be compatible with PHP < 5.2.3

= 0.4 =
* Fixed `<td>` tag that wasn't closed
* Changed regular expression pattern to be more liberal, to allow external URLs

= 0.3 =
* Updated compatibility to 2.9-rare (Subversion trunk version)