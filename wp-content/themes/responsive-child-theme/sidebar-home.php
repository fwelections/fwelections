<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Home Widgets Template
 *
 *
 * @file           sidebar-home.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2012 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/sidebar-home.php
 * @link           http://codex.wordpress.org/Theme_Development#Widgets_.28sidebar.php.29
 * @since          available since Release 1.0
 */
?>
    <div id="widgets" class="home-widgets">
        <div class="grid col-700" >
        
            
            <?php
            
            $recent_blog_posts = dg_get_last_blog_posts();
            $i = 0;
 
            ?>
            
            
            <?php foreach ($recent_blog_posts as $recent_blog_post):  ?>
            <?php $i++; ?>
            <div class="grid col-300 small-margin-botom <?php if ($i == 3) echo 'fit';?>">
                
            <?php responsive_widgets(); // above widgets hook ?>
            
            <?php if (is_array($recent_blog_post)) { ?>
            <div class="widget-wrapper home-widget-height">
            
                <div class="widget-title-home home-page-post-title"><a href="<?php echo get_permalink($recent_blog_post["ID"]) ?>" title="<?php echo wp_trim_words(translate($recent_blog_post["post_title"]),6); ?>" ><span class="homepage-title"><h4><?php  echo wp_trim_words(translate($recent_blog_post["post_title"]),6); ?></h4></span></a></div>
                <div class="textwidget">
                <?php echo $recent_blog_post["image"]; ?>
                <div class="home-page-post-text">
                <?php
                echo wp_trim_words(translate($recent_blog_post["post_content"]),20).'<br />';
                ?>
                </div>
                    <span class="dg-post-meta"><?php dg_post_meta_data($recent_blog_post["post_date"],$recent_blog_post["post_author"]); ?></span>
                </div>
            
            </div>
            <?php } else {   ?>
            <div class="widget-wrapper home-widget-height">
            
                <div class="widget-title-home home-page-post-title"><h4><?php echo dg_functions_get_no_blog_post_text(); ?></h4></div>
                <div class="textwidget">
                    &nbsp;
                </div>
            
            </div>	

            <?php } ?>
            <?php responsive_widgets_end(); // responsive after widgets hook ?>
                
            </div>
            
            <?php endforeach; ?>
            

            <div class="grid col-940 fit">
            
            <?php responsive_widgets(); // above widgets hook ?>
            
			
            <div class="widget-wrapper force-transparent force-no-margin more-news-padding">
            
            <div class="textwidget">

                <span class="link-more-news"><a href="/<?php echo qtrans_getLanguage(); ?>/more-news/"><?php echo dg_function_get_morenews(); ?></a></span>

            </div>    
                
            
        
            </div><!-- end of .widget-wrapper -->
			
            
            <?php responsive_widgets_end(); // after widgets hook ?>    
                
                
            </div>
            
            
            <hr>
            
            
            
            <?php $event = false; 
                
                if ($event) {
                
            ?>
            
            <div class="video-container grid col-940">
                
                
                
            <div class="grid col-620 no-margin-bottom">
               
            <?php responsive_widgets(); // above widgets hook ?>
            
			
            <div class="widget-wrapper livestream-block no-margin-bottom">
            
                
                
                
                <div class="widget-title-home"><span class="homepage-video-title"><h4><?php echo dg_functions_get_events_text(); ?><span style="vertical-align: super;font-size: 14px;">{Livestream}</span></h4></span></div>
                <div class="textwidget">
                      
                    <iframe width="430" height="285" src="http://www.ustream.tv/embed/13211411?v=3&amp;wmode=direct" scrolling="no" frameborder="0" style="border: 0px none transparent;">    </iframe>
                </div>
        
            </div><!-- end of .widget-wrapper -->
			
            
            <?php responsive_widgets_end(); // after widgets hook ?>
                
            </div>
             
                
            <div class="grid col-300 no-margin-bottom fit">
                
                <?php responsive_widgets(); // above widgets hook ?>
            
                
                
                <div class="widget-wrapper no-margin-bottom" style="padding-bottom: 4px;">

                <div class="textwidget">
                
                <?php  
                
                //$recent_event_post = dg_get_last_event_post();
                //if (isset($recent_event_post)) { ?>
                    
                
                <div class="home-page-event-text">
                <?php
                
                
                echo (translate(dg_function_get_livestream_body_text()));
                
                //echo wp_trim_words(translate($recent_event_post["post_content"]),20).'<br />';
                
                
                ?>
                </div>
                <span class="dg-post-meta"><?php //dg_post_meta_data($recent_event_post["post_date"],$recent_event_post["post_author"]); ?></span>
                
                <?php //} ?>
                
                </div>

                </div><!-- end of .widget-wrapper -->
                
                


             <?php responsive_widgets_end(); // after widgets hook ?>    
                
                
            </div>
            </div>
            
            <?php }
            
            ?>
            
            
        </div><!-- end of .col-700 -->
        
        <div class="grid col-220 fit social-connect-widget-bar" >
        
        <?php responsive_widgets(); // above widgets hook ?>
            
            <div class="widget-wrapper">

                    <div class="widget-title-home"><span class="homepage-title"><h4><?php echo dg_function_get_about_us_title_text(); ?></h4></span></div>
                    <div class="textwidget"><?php echo dg_function_get_about_us_body_text(); ?></div>

            </div><!-- end of .widget-wrapper -->
            
            <div class="widget-wrapper">

                <div class="widget-title-home"><span class="homepage-title"><h4><a href="https://github.com/fwelections" target="_blank"><?php echo dg_function_get_developers_title_text() ?></a></h4></span></div>
                <div class="textwidget"><a href="https://github.com/fwelections" target="_blank"><?php dg_print_github_image() ?></a></div>

            </div><!-- end of .widget-wrapper -->
            <div class="widget-wrapper">

                <div class="widget-title-home"></div>
                <div class="textwidget">
                    
                    <?php $options = get_option('responsive_theme_options');
					echo '<ul class="social-icons-custom">';
			
					if (!empty($options['twitter_uid'])) 
						echo '<li class="twitter-icon-custom social-icon"><a target="_blank" href="' . $options['twitter_uid'] . '">'
						.'<img src="' . get_stylesheet_directory_uri() . '/icons/twitter.png" width="24" height="24" alt="Twitter">'
						.'</a></li>';
	   
					if (!empty($options['facebook_uid'])) 
						echo '<li class="facebook-icon-custom social-icon"><a target="_blank" href="' . $options['facebook_uid'] . '">'
						.'<img src="' . get_stylesheet_directory_uri() . '/icons/facebook.png" width="24" height="24" alt="Facebook">'
						.'</a></li>';
					
					echo '<li class="rss-icon-custom social-icon"><a target="_blank" href="' .qtrans_convertURL(get_bloginfo('rss2_url','display') ). '">'
						.'<img src="' . get_stylesheet_directory_uri() . '/icons/rss.png" width="24" height="24" alt="RSS">'
						.'</a></li>';
	
					echo '</ul><!-- end of .social-icons -->';
         		?>
                    
                </div>

            </div><!-- end of .widget-wrapper -->
            
             
            
            <?php if (!dynamic_sidebar('home-widget-3')) : ?>
                <div class="widget-wrapper">

                    <div class="widget-title-home"><h4><?php _e('Home Widget 3', 'responsive'); ?></h4></div>
                    <div class="textwidget"><?php _e('This is your third home widget box. To edit please go to Appearance > Widgets and choose 8th widget from the top in area 8 called Home Widget 3. Title is also manageable from widgets as well.','responsive'); ?></div>

                </div><!-- end of .widget-wrapper -->
            <?php endif; //end of home-widget-3 ?>
                
                
                
            <div class="widget-wrapper">
            
                <div class="widget-title-home"></div>
                <div class="textwidget">
                
                
                <div class="fb-like-box" data-href="https://www.facebook.com/pages/FW/117399735076479" data-width="200" data-height="400" data-show-faces="true" data-stream="false" data-header="true"></div>
                </div>
        
            </div>
            
        <?php responsive_widgets_end(); // after widgets hook ?>    
            
            
        </div><!-- end of .col-300 -->

        
        
        
        
    </div><!-- end of #widgets -->