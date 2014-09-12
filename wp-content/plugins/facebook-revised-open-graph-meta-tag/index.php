<?php
/*
      Plugin Name: Facebook Revised Open Graph Meta Tag
      Plugin URI: http://thecodep0et.com/facebook-revised-open-graph-meta-tag-plugin/
      Description: Adds automatically the meta tags required by Facebook to your pages, posts, homepage.
      Version: 1.0
      Author: TheCodeP0et
      Author URI: http://thecodep0et.com/
*/

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

function fbrogmt() {
if (is_plugin_active('shopp/Shopp.php')) {
      
   
  if (shopp('catalog','is-product')) {

    $meta[] = __(trim(shopp('product','name','return=1'))) . ' - ' . shopp('product','price','return=1'); 
    $meta[] = shopp('product','link','return=1'); 
	$meta[]=get_option('blogname');//Site name
    

    //get summary, or use description if no summary is set.
    $description = trim(strip_tags(shopp('product','summary','return=1'))); 
    $long_description = trim(strip_tags(shopp('product','description','return=1')));     
    if ('' == $description) {
      $description = $long_description;
    }

    //truncate description to 300
    if (strlen($description) > 300) {
      $description = substr($description, 0, 297) . '...';
    }
	
	$meta[] = $description;
		$meta[]= 'product';

		foreach (all_images_shopp() as $img_meta) { // The loop to dish out all the images meta tags explained lower
	echo $img_meta;
	}


  }
  
  
	else if(is_single() ){ // Post
		if (have_posts()) : while (have_posts()) : the_post(); 

		$meta[]=get_the_title($post->post_title);// Gets the title
			$meta[]=get_permalink();// gets the url of the post
			$meta[]=get_option('blogname');//Site name
			$meta[]= the_excerpt_max_charlength(300) . '...'; //Description comes from the excerpt, because by using the_content, it will dish out the [caption id...]
			$meta[]= 'article';
			// $meta[]=get_the_image();//Gets the first image of a post/page if there is one  -- Remove this for now
			foreach (all_images() as $img_meta) { // The loop to dish out all the images meta tags explained lower
	echo $img_meta;
	}
		endwhile; endif; 
	}
	elseif(is_page() ){ // Page
		if (have_posts()) : while (have_posts()) : the_post(); 
			$meta[]=get_the_title($post->post_title);// Gets the title
			$meta[]=get_permalink();// gets the url of the post
			$meta[]=get_option('blogname');//Site name
			$meta[]= the_excerpt_max_charlength(300) . '...' ;  //Description comes from the excerpt, because by using the_content, it will dish out the [caption id...]
			$meta[]= 'article';
			// $meta[]=get_the_image();//Gets the first image of a post/page if there is one  -- Remove this for now
			foreach (all_images() as $img_meta) { // The loop to dish out all the images meta tags explained lower
	echo $img_meta;
	}
		endwhile; endif; 
	}
	
		elseif(is_category()) {
			global $post, $wp_query;
		$category_id = get_cat_ID(single_cat_title('',false));
    // Get the URL of this category
    $category_link = get_category_link( $category_id );
$term = $wp_query->get_queried_object();

if (is_plugin_active('wordpress-seo/wp-seo.php')) {  //checks for yoast seo plugin for description of category
				$metadesc = wpseo_get_term_meta( $term, $term->taxonomy, 'desc' );
				
				}
				else {
				
				$metadesc = category_description($category_id);
				}
		$meta[]=wp_title('', false);//Title
		$meta[]=$category_link;//URL
		$meta[]=get_option('blogname');//Site name
		$meta[]=$metadesc;//Description
		$meta[]= 'website';
		foreach (all_images() as $img_meta) { // The loop to dish out all the images meta tags explained lower
	echo $img_meta;
	}
	}
	elseif(is_home() || is_front_page()) {
		
		$meta[]=get_option('blogname');//Title
		$meta[]=get_option('siteurl');//URL
		$meta[]=get_option('blogname');//Site name
		$meta[]=get_option('blogdescription');//Description
		$meta[]= 'website';
	}

	else{
		
		$meta[]=get_option('blogname');//Title
		$meta[]=get_option('siteurl');//URL
		$meta[]=get_option('blogname');//Site name
		$meta[]=get_option('blogdescription');//Description
		$meta[]= 'article';
		
	}
  }
  /////////////////////////////////////////////////////////////////////
  //  IF SHOPP PLUGIN NOT ACTIVE OR INSTALLED
  ////////////////////////////////////////////////////////////////////
	else {
	
	if(is_single() ){ // Post
		if (have_posts()) : while (have_posts()) : the_post(); 

		$meta[]=get_the_title($post->post_title);// Gets the title
			$meta[]=get_permalink();// gets the url of the post
			$meta[]=get_option('blogname');//Site name
			$meta[]= the_excerpt_max_charlength(300) . '...'; //Description comes from the excerpt, because by using the_content, it will dish out the [caption id...]
			$meta[]= 'article';
			// $meta[]=get_the_image();//Gets the first image of a post/page if there is one  -- Remove this for now
			foreach (all_images() as $img_meta) { // The loop to dish out all the images meta tags explained lower
	echo $img_meta;
	}
		endwhile; endif; 
	}
	elseif(is_page() ){ // Page
		if (have_posts()) : while (have_posts()) : the_post(); 
			$meta[]=get_the_title($post->post_title);// Gets the title
			$meta[]=get_permalink();// gets the url of the post
			$meta[]=get_option('blogname');//Site name
			$meta[]= the_excerpt_max_charlength(300) . '...' ;  //Description comes from the excerpt, because by using the_content, it will dish out the [caption id...]
			$meta[]= 'article';
			// $meta[]=get_the_image();//Gets the first image of a post/page if there is one  -- Remove this for now
			foreach (all_images() as $img_meta) { // The loop to dish out all the images meta tags explained lower
	echo $img_meta;
	}
		endwhile; endif; 
	}
			elseif(is_category()) {
			global $post, $wp_query;
		$category_id = get_cat_ID(single_cat_title('',false));
    // Get the URL of this category
    $category_link = get_category_link( $category_id );
$term = $wp_query->get_queried_object();

if (is_plugin_active('wordpress-seo/wp-seo.php')) {  //checks for yoast seo plugin for description of category
				$metadesc = wpseo_get_term_meta( $term, $term->taxonomy, 'desc' );
				
				}
				else {
				
				$metadesc = category_description($category_id);
				}
		$meta[]=wp_title('', false);//Title
		$meta[]=$category_link;//URL
		$meta[]=get_option('blogname');//Site name
		$meta[]=$metadesc;//Description
		$meta[]= 'website';
		foreach (all_images() as $img_meta) { // The loop to dish out all the images meta tags explained lower
	echo $img_meta;
	}
	}
	elseif(is_home() || is_front_page()) {
		
		$meta[]=get_option('blogname');//Title
		$meta[]=get_option('siteurl');//URL
		$meta[]=get_option('blogname');//Site name
		$meta[]=get_option('blogdescription');//Description
		$meta[]= 'website';
	}

	else{
		
		$meta[]=get_option('blogname');//Title
		$meta[]=get_option('siteurl');//URL
		$meta[]=get_option('blogname');//Site name
		$meta[]=get_option('blogdescription');//Description
		$meta[]= 'article';
		
	}
	
	
	
	
	}
	
	echo tags($meta);
}

/* Output of the meta tags */
function tags($meta){

	$tag.="<meta property='og:title' content='".$meta[0]."'/>\n"; 
	$tag.="<meta property='og:url' content='".$meta[1]."'/>\n";
	$tag.="<meta property='og:site_name' content='".$meta[2]."'/>\n";
	$tag.="<meta property=\"og:description\" content=\"$meta[3]\"/>\n";
	$tag.="<meta property='og:type' content='".$meta[4]."'/>\n";
	return $tag;
}


function all_images() { // Gets all the images of a post, and put them in the og:image meta tag to have the ability to choose what thumbnail to have on Facebook
global $post;
$the_images = array();
if ( preg_match_all('/<img (.+?)>/', $post->post_content, $matches) ) { // Gets the images in the post content
        foreach ($matches[1] as $match) {
                foreach ( wp_kses_hair($match, array('http')) as $attr)
                    $img[$attr['name']] = $attr['value'];
               $the_images[] = "<meta property='og:image' content='".$img['src']."' />\n";
        }
		
}
else if (empty($the_images)) {   // Gets the image uploaded in the gallery
$args = array(	
'order'          => 'ASC',	
'orderby'        => 'menu_order',	
'post_type'      => 'attachment',	
'post_parent'    => $post->ID,	
'post_mime_type' => 'image',	
'post_status'    => null,	
'numberposts'    => -1,	);	

$attachments = get_posts($args);	
   
foreach ($attachments as $attachment) {		
	
  $the_images[] = "<meta property='og:image' content='".wp_get_attachment_url($attachment->ID)."' />\n";

			  } 
}
else {
 $the_images[] = "<meta property='og:image' content='".get_bloginfo('template_directory') . "/images/facebook-default.jpg' />\n"; // Default image if none 

}
return $the_images;
}


function all_images_shopp() { // Gets all the images of a product of Shopp
$the_images = array();
if ( preg_match_all('/<img (.+?)>/', shopp('product','coverimage','width=320&height=200&fit=all&quality=100&return=1'), $matches) ) { // Gets the images in the post content
        foreach ($matches[1] as $match) {
                foreach ( wp_kses_hair($match, array('http')) as $attr)
                    $img[$attr['name']] = $attr['value'];
               $the_images[] = "<meta property='og:image' content='".$img['src']."' />\n";
        }
		
}
else {
 $the_images[] = "<meta property='og:image' content='".get_bloginfo('template_directory') . "/images/facebook-default.jpg' />\n"; // Default image if none 

}
return $the_images;
}

/* Extracts the content, removes tags, cuts it, removes the caption shortcode */

function the_excerpt_max_charlength($charlength) {
$content = get_the_content(); //get the content
$content = strip_tags($content); // strip all html tags
$regex = "#([[]caption)(.*)([[]/caption[]])#e"; // the regex to remove the caption shortcude tag
$content = preg_replace($regex,'',$content); // remove the caption shortcude tag
$content = preg_replace( '/\r\n/', ' ', trim($content) ); // remove all new lines
   $excerpt = $content;
   $charlength++;
   if(strlen($excerpt)>$charlength) {
       $subex = substr($excerpt,0,$charlength-5);
       $exwords = explode(" ",$subex);
       $excut = -(strlen($exwords[count($exwords)-1]));
       if($excut<0) {
            return substr($subex,0,$excut);
       } else {
            return $subex;
       }
       return "[...]";
   } else {
    return $excerpt;
   }
}


//Add the meta tags to wp_head 
add_action('wp_head', 'fbrogmt');
?>