<?php

/*
Plugin Name: Speaker Deck Embed
Description: Embed Speaker Deck slideshows
Version: 1.1
Author: Matt Wiebe
Author URI: http://somadesign.ca/
*/

add_action( 'init', 'sd_add_speakerdeck_oembed' );
function sd_add_speakerdeck_oembed() {
	wp_oembed_add_provider( '#https?://speakerdeck.com/.*#i', 'https://speakerdeck.com/oembed.json', true );
}