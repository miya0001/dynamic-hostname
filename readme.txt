=== Dynamic Hostname ===
Contributors:      miyauchi, megumithemes, tekapo
Donate link:       https://wpist.me/
Tags: wp_home, site_url, hostname, vagrant cloud
Requires at least: 3.8
Tested up to:      3.9
Stable tag:        0.2.0
License:           GPLv2
License URI:       http://www.gnu.org/licenses/gpl-2.0.html

Set hostname dynamically for the development.

== Description ==

This plugin changes dynamically and automatically the host name which WordPress uses. For example, when you run WordPress on your different servers, for production, development or staging, the host name will be changed dynamically and those each sites won't have broken links. It's very useful when you use it with Vagrant Cloud.

= Some features =

* Temporarily changes the host name to the current host name ($_SERVER['HTTP_HOST']).
* Also replaces the host name of the links to the contents and the images in the same site.
* The host name included in the contents on the development server will be change to the one for the production server. (you don't need to replace the host name in the database when you move it to the production server.)
* The host name in the editor window temporarily replaced with the current host name, so when you edit some on the development server, you never have broken links.

= Hooks to use for replacing =

This plugin uses below filter hooks to replace the host name in URL.

`
$hooks = array(
"home_url",
"site_url",
"stylesheet_directory_uri",
"template_directory_uri",
"plugins_url",
"wp_get_attachment_url",
"theme_mod_header_image",
"theme_mod_background_image",
"the_content",
"upload_dir",
"widget_text",
);
`

Those hooks have also their own fileter hooks, so you can customize with other plugins etc. you are using.

`add_filter('dynamic_hostname_filters' function($hooks){
    $hooks[] = 'some_filter_hook';
    return $hooks;
});`

== Installation ==

= Manual Installation =

1. Upload the entire `/dynamic-hostname` directory to the `/wp-content/plugins/` directory.
2. Activate Aa through the 'Plugins' menu in WordPress.

== Changelog ==

= 0.1.0 =
* First release

