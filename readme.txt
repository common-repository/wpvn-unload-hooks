=== WPVN Unload Hooks ===
Contributors: Minh-Quan Tran (aka link2caro - a member of WordPressVN)
Donate link: http://link2caro.net/donate/
Tags: link2caro, wpvn, unload, hook, action, filter, unload hooks
Requires at least: 2.0
Tested up to: 2.8-bleeding-edge
Stable tag: 0.9.2

This plugin helps you know how hooks are called and let you unload actions/filters (this is useful when you want to unload, not deactive, plugins based on user-agent, themes or whatever you want)

== Description ==

*This plugin is destined to advanced users.*

*How to use?*

You just need to activate the plugin. Nothing changes for this release.
You have now two additional functions:
cr_hook_remove($hooks_to_find = array(), $exact = false, $display = true, $detail = false)
cr_hook_list($hookname = array(), $display = true, $detail = false) {

These functions are case-sensitive for actions/filters' names.

The function to remove actions/filters (cr_hook_remove) you should call before the hooked is made, or you cannot remove it. The best place is in functions.php of the theme, or even better, directly in the plugin file 'wpvn-unload-hooks.php'. (Be aware that calling in the plugin file should not print any output or you will mess up with Response HTTP header).
The function to list hooks and hooked actions/filters, you can call anywhere you want.

*Example*

cr_hook_list(); shows you everything.
cr_hook_list('wp_head'); shows you actions/filters that are hooked to 'wp_head'
cr_hook_remove(); nothing happens, lose your time.
cr_hook_remove('AJAX'); *All* actions/filters have that string in their names will be removed.
cr_hook_remove('AJAX', true); *All* actions/filters have the *exact* name 'AJAX' will be removed.

== Installation ==

1. Upload `wpvn-unload-hooks` to the `/wp-content/plugins/` directory, if you use customized `wp-content`, it's OK with WPVN Unload Hooks.
2. Activate the plugin through the 'Plugins' menu in WordPress

[More about WPVN Unload Hooks](http://link2caro.net/read/wpvn-unload-hooks/ "WPVN Unload Hooks")

== Changelog ==

0.9
Initial version

== Screenshots ==

1. Listing (WordPress 2.8)
2. Simple Removing (WordPress 2.8)
2. Array Removing (WordPress 2.8)