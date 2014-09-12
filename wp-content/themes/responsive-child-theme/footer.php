<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Footer Template
 *
 *
 * @file           footer.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2012 ThemeID
 * @license        license.txt
 * @version        Release: 1.2
 * @filesource     wp-content/themes/responsive/footer.php
 * @link           http://codex.wordpress.org/Theme_Development#Footer_.28footer.php.29
 * @since          available since Release 1.0
 */
?>
    </div><!-- end of #wrapper -->
    <?php responsive_wrapper_end(); // after wrapper hook ?>
</div><!-- end of #container -->
<?php responsive_container_end(); // after container hook ?>

<div id="footer" class="clearfix">

    <div id="footer-wrapper">
    
        <div class="grid col-940">
                <div>
                 
                    <div class="widget-title-home">&nbsp;</div>
                <div class="textwidget" style="font-size: 18px;">
                    
                    
                </div>
                    
                </div>
        </div>
        
        <div class="grid col-940">
        
        <div class="grid col-540">
		<?php if (has_nav_menu('footer-menu', 'responsive')) { ?>
	        <?php wp_nav_menu(array(
				    'container'       => '',
					'fallback_cb'	  =>  false,
					'menu_class'      => 'footer-menu',
					'theme_location'  => 'footer-menu')
					); 
				?>
         <?php } ?>
         </div><!-- end of col-540 -->
         
         <div class="grid col-380 fit">
         <?php $options = get_option('responsive_theme_options');
					
            // First let's check if any of this was set
		
         ?>
         </div><!-- end of col-380 fit -->
         
         </div><!-- end of col-940 -->
         <?php get_sidebar('colophon'); ?>
                
        <div class="grid col-620 copyright">
            <?php esc_attr_e('&copy;', 'responsive'); ?> <?php _e(date('Y')); ?><a href="<?php echo home_url('/') ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
                <?php bloginfo('name'); ?>
                
            </a>
            FW: is an initiative of <a href="http://www.democracyinternational.com/" target="_blank" /><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/di-x-small.png" /></a> with support from the Middle East Partnership Initiative.
                
        </div><!-- end of .copyright -->
        
        <div class="grid col-300 scroll-top fit"><a href="#scroll-top" title="<?php esc_attr_e( 'scroll to top', 'responsive' ); ?>"><?php _e( '&uarr;', 'responsive' ); ?></a></div>
        
        
        
        
        
    </div><!-- end #footer-wrapper -->
    
</div><!-- end #footer -->

<?php wp_footer(); ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=305707542824764";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>