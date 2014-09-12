<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Header Template
 *
 *
 * @file           header.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2012 ThemeID
 * @license        license.txt
 * @version        Release: 1.3
 * @filesource     wp-content/themes/responsive/header.php
 * @link           http://codex.wordpress.org/Theme_Development#Document_Head_.28header.php.29
 * @since          available since Release 1.0
 */
?>
<!doctype html>
<!--[if !IE]>      <html class="no-js non-ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="no-js ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

<title><?php wp_title('&#124;', true, 'right'); ?><?php bloginfo('name'); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link href='http://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>


<?php wp_enqueue_style('responsive-style', get_stylesheet_uri(), false, '1.8.6');?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> style="background: url(<?php echo get_stylesheet_directory_uri(); ?>/images/blue_back<?php if (!is_home()) echo '_short'; ?>.jpg) center top no-repeat;background-color:#eee;" >

<?php responsive_container(); // before container hook ?>
<div id="container" class="hfeed" >
         
    <?php responsive_header(); // before header hook ?>
    <div id="header">
        
        <div id="fw_logo_top" style="float:left;margin-top:5px;margin-left:20px;">
           
            Empowered by <a href="http://www.democracyinternational.com/" target="_blank" /><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/di-png-trans-bw.png" /></a>
            
        </div>
        
        <div id="lang" style="float:right; margin-top:5px;">
            
            
            <div id="social-bar" style="float:left; margin-right:-50px;">
            	 <?php do_action( 'wordpress_social_login' ); ?> 
            </div>
            <div id="lang-selector" style="float:left; margin-top:-20px; margin-right:-5px; height:32px;">
            	 <?php if(function_exists('qtrans_generateLanguageSelectCode')){ ?>
                    <div id="language-selector">
                        <?php echo qtrans_generateLanguageSelectCode('text'); // You can use image, text or both as an argument here ?>
                    </div>
        		 <?php } ?>
            </div>
            <div style="clear:both;"></div>
        </div>
        <div style="clear:both;"></div>
        
        <div id="header-menu" style="margin-top:15px;">
            <?php if (is_rtl()) { ?>
                <div style="float:right; width:690px; right:5px; position:relative;">
        	
            <?php } else { ?>
                <div style="float:left; width:690px; left:5px; position:relative;">
            <?php } ?>
            <?php
				if ( function_exists( 'register_nav_menus' ) ) {
						register_nav_menus(
						array(
						'home-menu-en' => 'Home Menu EN',
						'home-menu-fr' => 'Home Menu FR',
					'home-menu-ar' => 'Home Menu AR',
							)
						);
				} 
						wp_nav_menu(array(
                        'menu' => 'home-menu-'.qtrans_getLanguage() ,
                        'container'       => '',
                        'theme_location'  => 'header-menu')
                        );
    		?>
            
            </div>
            <?php if (is_rtl()) { ?>
                <div style="float:left; width:210px;background-color: #FFF;">
        	
            <?php } else { ?>
                <div style="float:right; width:210px;background-color: #FFF;">
            <?php } ?>
            
                    <div class="fb-like-box" data-href="https://www.facebook.com/pages/FW/117399735076479" data-width="210" data-height="60" data-show-faces="false" data-stream="false" data-show-border="false" data-header="false"></div>
                    
            <?php
//            $widgetdata=array (
//            'title' => 'NewsLetter',
//            'instruction' => '',
//            'lists' => 
//            array (
//            0 => '1',
//            ),
//            'lists_name' => 
//            array (
//            1 => 'My first list',
//            ),
//            'autoregister' => 'not_auto_register',
//            'labelswithin' => 'labels_within',
//            'customfields' => 
//            array (
//            'email' => 
//            array (
//            'label' => 'Email',
//            ),
//            ),
//            'submit' => 'Ok',
//            'success' => 'Check your inbox now to confirm your subscription.',
//            'widget_id' => 'wysija-2-php',
//            );
//            $widgetNL=new WYSIJA_NL_Widget(1);
//            $subscriptionForm= $widgetNL->widget($widgetdata,$widgetdata);
//            echo $subscriptionForm;
            
            ?>
            
            
            </div>
            <div style="clear:both;"></div>
        </div>
        
        
        <div id="main_header" style="margin-top:20px;">
        
            <?php if (is_home()) { ?>
            <div id="logoo" style="float:left;">
                <a href="<?php echo home_url().'/'.  qtrans_getLanguage(); ?>">
                    <img  src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo_fw.png" width="160" height="350" alt="Forward" />
                </a>
            </div>
            <?php } ?>
            
            
            <div id="header-slider" style="float:right; margin-right:15px;">
				<?php
                    if (function_exists('get_thethe_image_slider')) {
                       if (is_home()) print get_thethe_image_slider('mainslider-'.  qtrans_getLanguage());
                    }
                ?>
            </div>
            
            <div style="clear:both;"></div>
            
            
        </div><!-- /main_header -->

    </div>
    
    <?php if (is_home()) { ?>
    <div style="height:50px;">&nbsp;</div>
    
    <?php } else { ?>
    <div style="height:100px;">&nbsp;</div>
    
    <?php } ?>
    
    <div id="wrapper" class="clearfix">
    <?php responsive_in_wrapper(); // wrapper hook ?>
