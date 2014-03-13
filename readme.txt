=== Dynamic Hostname ===
Contributors:      miyauchi
Donate link:       https://wpist.me/
Tags: wp_home, site_url, hostname, vagrant cloud
Requires at least: 3.8
Tested up to:      3.9
Stable tag:        0.1.0
License:           GPLv2
License URI:       http://www.gnu.org/licenses/gpl-2.0.html

Set hostname dynamically for the development.

== Description ==

このプラグインを使用すると、開発用サーバーやステージング用サーバーなど、本番環境とはちがうサーバー上でWordPressを動作させる際に、ホスト名を自動的に変更しスタイルシートや画像などのリンク切りが起こらなくなります。

たとえば Vagrant Cloud などと合わせて使うと、すごく便利です。

= Some features =

* ホスト名を一時的に、現在のホスト名($_SERVER['HTTP_HOST'])に変更します。
* コンテンツ内の内部リンク、画像へのリンクなども現在のホスト名に置き換えます。
* 開発サーバー上で保存されたコンテンツ内に含まれるホスト名は、保存時に自動的に本番環境用のホスト名に変換します。(本番サーバーへ移行する際にデータベース内のデータを変換する必要がありません。)
* エディター内のホスト名は、一時的に現在のホスト名に変換されてエディターに出力されるため、開発環境等で編集を行ってもリンクがきれません。

= 変換するフック =

このプラグインは以下のフィルターフックで、URL内に含まれるホスト名の変換を行っています。

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

この変換対象となるフックにはさらにフィルターフックもありますので、みなさんがご利用になる外のプラグイン等との組み合わせにあわせてカスタマイズすることができます。

`add_filter('dynamic_hostname_filters' function($hooks){

});`

== Installation ==

= Manual Installation =

1. Upload the entire `/dynamic-hostname` directory to the `/wp-content/plugins/` directory.
2. Activate Aa through the 'Plugins' menu in WordPress.

== Changelog ==

= 0.1.0 =
* First release

