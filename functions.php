<?php 

//Register the New Student and Old Student Menus
function register_all_menu() {
   register_nav_menus ( array (
      'ns-menu' => 'New Student Menu',
      'os-menu' => 'Old Student Menu'
   ) );
}
add_action( 'init', 'register_all_menu' );

//Customize the wp-login.php page (only shown during a failed login at mobile menu)
function my_login_logo_url() {
       return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
       return 'Dharā Dhamma';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

function my_login_logo() { 
    ?>
    <style type="text/css">
     body.login div#login h1 a {
         background-image: url(<?php echo get_stylesheet_directory_uri();?>/images/aniwheel.gif );
         background-size: 80px 80px;
      }
		
		body.login div#login_error a {
			display: none;
		}

		body.login p#nav {
			display: none;
		}
   </style>
   <?php
}
add_action( 'login_enqueue_scripts', 'my_login_logo' );


// Local news feeds
function local_news_feed ( $name, $categoryID ) {
   $recent_posts = wp_get_recent_posts ( array ( 'category' => $categoryID, 'post_status' => 'publish' ) );
   if ( !empty ( $recent_posts ) ) {
	  echo "<h2>$name News</h2>";
	  echo '<ul class="local-page-news-items">';
	  foreach ( $recent_posts as $recent ) {
		 echo '<li class="home-page-news-item">';
		 echo '<a href="' . get_permalink($recent["ID"]) . '">' . $recent["post_title"].'</a>';
		 echo '</li>';
	  }
	  echo '</ul>';
   } 
   wp_reset_query();
}

//Useful functions for checking if we're on an os-page or we want the os-menu, for use in other places in theme
function prefers_os_menu ( $wp ) {

   $current_url = home_url ( add_query_arg ( array(), $wp->request ) );

   if ( preg_match ( "|/os|i", $current_url ) ) {
      return true;

   } else if ( preg_match ( "|/category/|i", $current_url ) ) {
      $current_announcements_ID = 50;
      $old_announcements_ID = 49;
      $prefers_ns_categories = array ( $current_announcements_ID, $old_announcements_ID ); 

      $cat_ID = get_queried_object()->term_id;

      return !in_array ( $cat_ID, $prefers_ns_categories );

   } else if ( is_single() ) {
      return true;
      
   } else if ( is_search() ) {
      return true;

   } else if ( is_content_restricted() ) {
      return true;
   }

   return false;
}

function is_os_page ( $wp ) {
   $is_os_page = false;
   if ( is_user_logged_in() && prefers_os_menu ( $wp ) ) {
      $is_os_page = true;
   }
   return $is_os_page;
}

function is_content_restricted ( ) {
   //get the slug requested 
   $slug = $_SERVER [ 'REQUEST_URI' ];

   $post_restricted = false;
   $page_restricted = false;

   //First check if it's a page and restricted
   $page = get_page_by_path ( $slug );

   if ( !is_null ( $page ) ) {
      $page_id = $page->ID;
      $page_restricted = is_restricted_rs ( $page_id );

   } else {
      //Then check if it's a post and restricted
      $args = array(
        'name'        => $slug,
        'post_type'   => 'post',
        'post_status' => 'publish',
        'numberposts' => 1
      );

      $my_posts = get_posts ( $args );

      if ( $my_posts ) { 
         $post_id = $my_posts[0]->ID; 
         $post_restricted = is_restricted_rs ( $post_id );
      }
   }

   return $post_restricted || $page_restricted;
}

// This function returns the destination URL after a logout as a string.
function url_after_logout( $wp ) {
   $url = home_url();
   if ( is_search() ) {
      // Search is a good place to stay after logging out.
      // It only needs special handling because both
      // get_permalink() and weird about search.
      $url = get_search_link();
   } else if ( is_category() ) {
      $category = get_queried_object();
      $url = get_category_link ( $category->term_id );
   } else {
      $permalink = get_permalink();
      if ( $permalink ) {
         // Proper page/post with permalink. Stay there.
         $url = $permalink;
      }
   }  
   return $url;
}

//Add current_page_ancestor to news top-level menu item
function cpt_archive_classes( $classes , $item ){
    if ( is_archive() || is_single() ) {
       $classes = str_replace( 'menu-item-' . get_theme_mod('dhamma_news_menu_item_id'), 'menu-item-4942 current_page_ancestor', $classes );
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'cpt_archive_classes', 10, 2 );


//This removes the admin bar from everyone but admins. 
add_action('init', 'remove_admin_bar');

function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	  show_admin_bar(false);
	}
}

//This blocks non-administrative users from accessing the dashboard, redirects to home page instead
add_action( 'init', 'blockusers_init' );
function blockusers_init() {
    if ( is_admin() && ! current_user_can( 'administrator' ) &&
       ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
        wp_redirect( home_url() );
        exit;
    }
}

/**
 * Improves the caption shortcode with HTML5 figure & figcaption; microdata & wai-aria attributes
 * 
 * @param  string $val     Empty
 * @param  array  $attr    Shortcode attributes
 * @param  string $content Shortcode content
 * @return string          Shortcode output
 */
function dhamma_img_caption_shortcode_filter($val, $attr, $content = null) {
   extract(shortcode_atts(array(
      'id'      => '',
      'align'   => 'aligncenter',
      'width'   => '',
      'caption' => ''
   ), $attr));
   
   // No caption, no dice... But why width? 
   if ( 1 > (int) $width || empty($caption) )
      return $val;
 
   if ( $id )
      $id = esc_attr( $id );
     
   // Add itemprop="contentURL" to image - Ugly hack
   $content = str_replace('<img', '<img itemprop="contentURL"', $content);

   $retMe = "";

   if ( $align == "aligncenter" ) $retMe .= "<div class='image-caption-center'>";
   else if ( $align == "alignleft" ) $retMe .= "<div class='image-caption-left'>";
   else if ( $align == "alignright" ) $retMe .= "<div class='image-caption-right'>"; 

   $retMe .= '<figure id="' . $id . '" aria-describedby="figcaption_' . $id . '" class="wp-caption ' . esc_attr($align) . '" itemscope itemtype="http://schema.org/ImageObject" style="width: ' . (0 + (int) $width) . 'px">' . do_shortcode( $content ) . '<figcaption id="figcaption_'. $id . '" class="wp-caption-text" itemprop="description">' . $caption . '</figcaption></figure>';

   $retMe .= "</div>";

   return $retMe;
}
add_filter( 'img_caption_shortcode', 'dhamma_img_caption_shortcode_filter', 10, 3 );


//Customize the "[...]" read more link at the end of the_excerpt() 
function new_excerpt_more( $more ) {
	return '<p><a class="read-more" href="'. get_permalink( get_the_ID() ) . '">Read the rest of this entry »</a></p>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );


/* Add theme customization interface to control panel */
function dhara_customize_register( $wp_customize ) {
	/**
	 * Adds textarea support to the theme customizer
	 */
	class dhara_textarea_control extends WP_Customize_Control {
	    public $type = 'textarea';

	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	            </label>
	        <?php
	    }
	}

	$wp_customize->add_section(
	    'dhara_customizer',
	    array(
	        'title'     => 'Theme Customization',
	        'priority'  => 199
	    )
	);

	$wp_customize->add_setting('dhamma_short_location', array('transport' => 'refresh'));
	$wp_customize->add_control('dhamma_short_location', array('section' => 'dhara_customizer', 'label' => 'Header Short Location', 'type' => 'text'));

	$wp_customize->add_setting('dhamma_schedule_link', array('transport' => 'refresh', 'sanitize_callback' => 'dhara_sanitize_uri'));
	$wp_customize->add_control('dhamma_schedule_link', array('section' => 'dhara_customizer', 'label' => 'Schedule Link (for mobile menu)', 'type' => 'text'));

	$wp_customize->add_setting('dhamma_picture_icon', array('transport' => 'refresh', 'sanitize_callback' => 'dhara_sanitize_uri'));
	$wp_customize->add_control('dhamma_picture_icon', array('section' => 'dhara_customizer', 'label' => 'Picture Icon URL (Top Left)', 'type' => 'text'));

	$wp_customize->add_setting('dhamma_news_menu_item_id', array('transport' => 'refresh'));
	$wp_customize->add_control('dhamma_news_menu_item_id', array('section' => 'dhara_customizer', 'label' => 'News Menu Item Post ID (For Current Page Menu Highlighting)', 'type' => 'text'));
   
	$wp_customize->add_setting('dhamma_title_separator', array('transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field'));
	$wp_customize->add_control('dhamma_title_separator', array('section' => 'dhara_customizer', 'label' => 'Separator for Browser Title', 'type' => 'text'));
}
add_action( 'customize_register', 'dhara_customize_register' );

function dhara_sanitize_uri($uri){
	if('' === $uri){
		return '';
	}
	return esc_url_raw($uri);

}

