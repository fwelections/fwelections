<?php


function dg_function_get_youtube_text() {
    
    return translate("<!--:en-->Latest Youtube videos<!--:--><!--:fr-->Dernières vidéos sur Youtube<!--:--><!--:ar-->أحدث مقاطع الفيديو يوتيوب<!--:-->");
    
}

function dg_signupwith_text() {
    
    return translate("<!--:en-->Sign up with<!--:--><!--:fr-->Inscrivez vous avec<!--:--><!--:ar--> الاشتراك باستخدام<!--:-->");
    
    
}


function dg_get_registration_reminder_text() {
    return translate("<!--:en-->Please click here to complete registration<!--:--><!--:fr-->Cliquez ici pour terminer votre inscription<!--:--><!--:ar-->إنقر هنا لكي تكمل التسجيل<!--:-->");
    
}


function dg_function_get_about_us_title_text() {
    
    return translate("<!--:en-->About Us<!--:--><!--:fr-->A propos de nous<!--:--><!--:ar-->من نحن<!--:-->");
    
}




function dg_function_get_about_us_body_text() {
    
    return translate("<!--:en-->FW: is an informal, web-based, community of civic activists, technology junkies, academics, bloggers, journalists, and citizens interested in learning about and sharing new approaches and tools for safeguarding elections. <!--:--><!--:fr-->FW : est une plateforme informelle pour les activistes civiques, les adeptes de la technologie, les universitaires, les bloggeurs, les journalistes, les fervents des élections  intéressés par l'apprentissage et le partage de nouvelles approches et outils pour la sauvegarde des élections.<!--:--><!--:ar--> :FW  هي شبكة غير رسمية لنشطاء المجتمع المدني، و المولعين بالتكنولوجيا، والأكاديميين والمدونين، والصحفيين المهتمين بالتعمق في مجال الانتخابات و تقاسم الخبرات و التجارب لضمان نزاهتها<!--:-->");
}

function dg_function_get_livestream_title_text() {
    
    return translate("<!--:en-->Event of the day<!--:--><!--:fr-->Événement du jour<!--:--><!--:ar-->حدث اليوم<!--:-->");
    
}

function dg_function_get_livestream_body_text() {
    
    return translate("<!--:en-->The FW Tunisia ElecTech Un/Conference will be livestreamed on March 4, 2013 beginning 9:00 CET<!--:--><!--:fr-->La FW Tunisie ElecTech Non-conférence sera diffusée en direct le 4 ​​Mars , 2013  à partir de 09:00 CET<!--:--><!--:ar-->FW  سيتم بث مؤتمر مباشرة على موقعنا يوم الاثنين 4 مارس 2013على الساعة 09:00 CET<!--:-->");
    
}


function dg_function_get_developers_title_text() {
    
    return translate("<!--:en-->Developers<!--:--><!--:fr-->Développeurs<!--:--><!--:ar--> للمطورين<!--:-->");
    
}

function dg_function_get_developers_body_text() {
    
    return translate("<!--:en-->Lorem Ipsum is simply dummy text of the printing and typesetting industry.<!--:--><!--:fr-->Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression.<!--:--><!--:ar-->أبجد هوز هو مجرد دمية النص من التنضيد والطباعة والصناعة.<!--:-->");
    
}

function dg_function_get_morenews() {
    return translate("<!--:en-->More News ...<!--:--><!--:fr-->Plus d'actualités ...<!--:--><!--:ar-->المزيد من الأخبار ...<!--:-->");
    
}

function dg_functions_get_more_text() {
    return translate("<!--:en-->Read More ...<!--:--><!--:fr-->Lire plus ...<!--:--><!--:ar-->اقرأ المزيد ...<!--:-->");
}

function dg_functions_get_events_text() {
    return translate("<!--:en-->Forward / Events<!--:--><!--:fr-->Forward / Événements<!--:--><!--:ar-->إلى الأمام / أحداث<!--:-->");
}

function dg_functions_get_no_blog_post_text() {
    return translate("<!--:en-->No Blog Posts<!--:--><!--:fr-->No Blog Posts<!--:--><!--:ar-->No Blog Posts<!--:-->");
}

function dg_functions_get_no_wiki_post_text() {
    return translate("<!--:en-->No Wiki Posts<!--:--><!--:fr-->No Wiki Posts<!--:--><!--:ar-->No Wiki Posts<!--:-->");
}

function dg_get_last_blog_posts() {
    
    
        // all posts excpect events category
        //$events_category = get_category_by_slug('events');
        //$events_category_id = $events_category->term_id;
        //$blog_post_args = array( 'numberposts' => '3','category__not_in' => array($events_category_id) );
        $blog_post_args = array( 'numberposts' => '3','post_status' => 'publish' );
	$recent_blog_posts = wp_get_recent_posts( $blog_post_args );
        if (count($recent_blog_posts) > 0) {
            
            for ($i=0;$i < 3;$i++) {
                
                if (isset($recent_blog_posts[$i])) {

                    if (has_post_thumbnail($recent_blog_posts[$i]['ID'])) {
                        $recent_blog_posts[$i]['image'] = get_the_post_thumbnail($recent_blog_posts[$i]['ID'],'thumbnail');
                    }
                    else {
                        $recent_blog_posts[$i]['image'] = '<img class="attachment-thumbnail wp-post-image" src="' . get_stylesheet_directory_uri() . '/images/wordpress150.jpg" width="150" height="150" alt="wordpress" />';
                    }

                }
                 
            }
            
            return $recent_blog_posts;
            
            
        }
        else {
            return false;
        }
        
        
}

function dg_get_last_wiki_post() {
    
        $wiki_post_args = array( 'numberposts' => '1' , 'post_type' => 'wiki' );
	$countries_posts = wp_get_recent_posts( $wiki_post_args );
        if (count($countries_posts) > 0) {
            
            if (has_post_thumbnail($countries_posts[0]['ID'])) {
                
                $countries_posts[0]['image'] = get_the_post_thumbnail($countries_posts[0]['ID'],'thumbnail');
                
            }
            else {
                $countries_posts[0]['image'] = '<img class="attachment-thumbnail wp-post-image" src="' . get_stylesheet_directory_uri() . '/images/wordpress150.jpg" width="150" height="150" alt="wordpress" />';
            }
            
            
            return $countries_posts[0];
        }
        else {
            return false;
        }
        
    
}

function dg_get_last_event_post() {
    
    
        // all posts excpect events category
        $events_category = get_category_by_slug('events');
        $events_category_id = $events_category->term_id;
        $blog_post_args = array( 'numberposts' => '1','category' => $events_category_id );
	$recent_blog_posts = wp_get_recent_posts( $blog_post_args );
        if (count($recent_blog_posts) > 0)
        return $recent_blog_posts[0];
        else return false;
        
        
}


function dg_post_meta_data($post_date,$post_author) {
	printf( __( '<span class="%1$s">Posted on </span>%2$s<span class="%3$s"> by </span>%4$s', 'responsive' ),
	'meta-prep meta-prep-author posted', 
	sprintf( '<span class="timestamp">%1$s</span>', apply_filters('get_the_date',mysql2date(get_option('date_format'),$post_date),'')),
	'byline',
	sprintf( '<span class="author vcard">%1$s</span>',  get_author_name($post_author))
	);
}

        
function dg_print_github_image() {
    echo '<img class="attachment-thumbnail wp-post-image" src="'.get_stylesheet_directory_uri() . '/images/github.png" width="150" height="150" />';
}



function dg_get_organization_title() {
    return translate("<!--:en-->Organization<!--:--><!--:fr-->Organisation<!--:--><!--:ar-->منظمة<!--:-->");
}


function dg_get_country_title() {
    return translate("<!--:en-->Country<!--:--><!--:fr-->Pays<!--:--><!--:ar-->بلد<!--:-->");
}

function dg_get_city_title() {
    return translate("<!--:en-->City<!--:--><!--:fr-->Ville<!--:--><!--:ar-->مدينة<!--:-->");
}


function dg_get_none_country_text() {
     return translate("<!--:en-->None<!--:--><!--:fr-->Aucun<!--:--><!--:ar-->لا شيء<!--:-->");
}


function dg_get_countries_list() {
    
    
    $countries_post_args = array( 'post_type' => 'countries' , 'numberposts' => 243 , 'orderby' => 'post_title', 'order' => 'ASC',);
     
	$countries_posts = wp_get_recent_posts( $countries_post_args );
        if (count($countries_posts) > 0) {
            
            return $countries_posts;
        }
        else {
            return false;
        }
    
}

        

add_filter('post_type_link', 'qtrans_convertURL');

        
        

?>
