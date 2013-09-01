<?php

// Some tricky things for your WordPress

// Disable admin bar
show_admin_bar(false);

// Disable admin bar in admin area
function hide_admin_bar() {
	remove_action('admin_footer', 'wp_admin_bar_render', 1000);
	function remove_padding_admin_bar() {
		echo '<style>body.admin-bar #wpcontent, body.admin-bar #adminmenu {padding-top: 0px !important;}</style>';
	}
	add_filter('admin_head', 'remove_padding_admin_bar');
}
add_filter('admin_head', 'hide_admin_bar');

// Remove gravatar from admin bar
function hide_avatar_admin() {
	add_filter('pre_option_show_avatars', '__return_zero');
}
add_action('admin_bar_menu', 'hide_avatar_admin', 0 );

// Clean up the site head
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'wp_generator');

// Enable thumbnail
add_theme_support('post-thumbnails');

// Add custom menus
register_nav_menus(array(
	'nav_1' => __('Nav 1')
));

// Disable update notifier
add_filter('pre_site_transient_update_core', create_function('$a', 'return null;'));

// Custom CSS for the whole admin area
// You have to create .css file with name admin.css
function admin_css() {
	echo '<link rel="stylesheet" type="text/css" href="'. get_bloginfo('template_directory') .'/admin.css"/>';
}
add_action('admin_head', 'admin_css');

// Add CSS to login page
// You have to create .css file with name admin.css
function login_files() {
	echo '<link rel="stylesheet" type="text/css" href="'. get_bloginfo('template_directory') .'/css/login.css" />';
}
add_action('login_head', 'login_files');

// Theme the TinyMCE editor
// You have to create .css file with name editor.css
add_editor_style('css/editor.css');

// Remove widgets
// More info: http://codex.wordpress.org/Function_Reference/unregister_widget
function remove_widgets() {
	unregister_widget('WP_Widget_Meta');
}
add_action('widgets_init', 'remove_widgets');

// Stop images getting wrapped up in p tags when they get dumped out with the_content() for easier theme styling
function remove_img_ptags($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'remove_img_ptags');

// Customize admin footer left
function custom_admin_footer_left() {
	echo "Whatever you want to write.";
} 
add_filter('admin_footer_text', 'custom_admin_footer_left');

// Customize admin footer right
function custom_admin_footer_right() {
	return "Haha I hacked this.";
}
add_filter('update_footer', 'custom_admin_footer_right', 9999);

?>