<?php

/*
	Plugin Name: WPTB Language
	Plugin URI: http://www.wptoolbox.net
	Description: Easily switch your Wordpress interface to any language, available in the WP Language Repository.
	Version: 1.0.1
	Author: Stanil Dobrev
	Author URI: http://www.wptoolbox.net
    Copyright 2012 wptoolbox.net (email : support@wptoolbox.net)
*/


# Compatibilty checks
# -----------------------------------------------------

// get wordpress version number and fill it up to 9 digits
$int_wp_version = preg_replace('#[^0-9]#', '', get_bloginfo('version'));
while(strlen($int_wp_version) < 9) $int_wp_version .= '0'; 

// get php version number and fill it up to 9 digits
$int_php_version = preg_replace('#[^0-9]#', '', phpversion());
while(strlen($int_php_version) < 9) $int_php_version .= '0'; 

if ($int_wp_version >= 300000000 && 		// Wordpress version > 3.0
	$int_php_version >= 520000000 && 		// PHP version > 5.2
	defined('ABSPATH') && 					// Plugin is not loaded directly
	defined('WPINC')) {						// Plugin is not loaded directly
	define('WPTBLANG_DIR', dirname(__FILE__));
	define('WPTBLANG_URL', plugins_url('/', __FILE__));
	define('WPTBLANG_PLUGIN_NAME' , 'WPTB Language');
	define('WPTBLANG_PLUGIN_SLUG' , 'wptblang');
	define('WPTBLANG_PLUGIN_VERSION' , '1.0.1');
	require_once(dirname(__FILE__).'/class.main.php');
	$wptlblangplugin = new wpTBLang();
}
else add_action('admin_notices', 'wptblang_incomp');

function wptblang_incomp(){
	echo '<div id="message" class="error">
	<p><b>The "WP ToolLink" Plugin does not work on this WordPress installation!</b></p>
	<p>Please check your WordPress installation for following minimum requirements:</p>
	<p>
	- WordPress version 3.0 or higer<br />
	- PHP version 5.2 or higher<br />
	</p>
	<p>Do you need help? Contact <a href="mailto:support@wptoolbox.net">Support</a></p>
	</div>';
}


?>