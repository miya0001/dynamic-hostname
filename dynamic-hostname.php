<?php
/*
Plugin Name: Amimoto SSL
Author: Takayuki Miyauchi
*/

$vagrant_cloud_fix = new Vagrant_Cloud_Fix();
$vagrant_cloud_fix->register();

class Vagrant_Cloud_Fix {

private $home_url;

function register()
{
    $this->home_url = home_url();
    add_action('plugins_loaded', array($this, 'plugins_loaded'));
}

public function plugins_loaded()
{
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
    );

    foreach ($hooks as $hook) {
        add_filter($hook, array($this, 'replace_host_name'));
    }

    add_action('save_post', array($this, 'save_post'), 10, 10);
}

public function save_post($id, $post)
{
    if (preg_match("/\.vagrantshare\.com$/", $_SERVER['HTTP_HOST'])) {
        remove_action('save_post', array($this, 'save_post'));
        $post->post_content = str_replace('http://'.$_SERVER['HTTP_HOST'], $this->home_url, $post->post_content);
        wp_update_post($post);
        add_action('save_post', array($this, 'save_post'), 10, 10);
    }
}

public function replace_host_name($uri)
{
    if (preg_match("/\.vagrantshare\.com$/", $_SERVER['HTTP_HOST'])) {
        return str_replace($this->home_url, 'http://'.$_SERVER['HTTP_HOST'], $uri);
    } else {
        return $uri;
    }
}

}

// EOF
