<?php
/**
 * wolffpress functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wolffpress
 */

if ( ! function_exists( 'wolffpress_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wolffpress_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on wolffpress, use a find and replace
	 * to change 'wolffpress' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'wolffpress', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'wolffpress' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wolffpress_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'wolffpress_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wolffpress_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wolffpress_content_width', 640 );
}
add_action( 'after_setup_theme', 'wolffpress_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wolffpress_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wolffpress' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'wolffpress' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'wolffpress_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wolffpress_scripts() {
	wp_enqueue_style( 'wolffpress-style', get_stylesheet_uri() );

  wp_enqueue_script( 'wolffpress-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'wolffpress-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

  wp_enqueue_script( 'jquery' );  

  wp_enqueue_script( 'flex-js', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array(), false, true); 

  wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/js/custom.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wolffpress_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

$first_picture = '';
$first_description = '';

//build_page_content displays flexible content from the advanced custom fields on the wordpress backend of the pege calling it.
function build_page_content(){
  // check if the flexible content field has rows of data
  if( have_rows('page_content') ):

       // loop through the rows of data
      $block_num = 0;
      while ( have_rows('page_content') ) : the_row();
       $block_num++;//starts at 1

          if( get_row_layout() == 'slider_block' ):

            build_slider($block_num);

          elseif( get_row_layout() == 'banner_block' ):

            build_banner($block_num);

          elseif( get_row_layout() == 'body_block' ): 

            build_body_block($block_num);
          
          elseif( get_row_layout() == 'side_by_side' ): 

            build_side_by_side($block_num);

          elseif( get_row_layout() == 'accordion_block' ):

            build_accordian_block($block_num);

          elseif( get_row_layout() == 'split_body_block' ): 

            build_split_body_block($block_num);

          elseif( get_row_layout() == 'social_links' ): 

            build_social_links($block_num);

          elseif( get_row_layout() == 'divided_block' ): 

            build_divided_block($block_num);

          elseif( get_row_layout() == 'start_wrapper' ): 

            build_start_wrapper($block_num);
            $block_num--;

          elseif( get_row_layout() == 'end_wrapper' ): 

            build_end_wrapper($block_num);
            $block_num--;

          endif;

      endwhile;

  endif;

}

function build_body_block($block_num){
  $title = get_sub_field('body_title');
  $content = get_sub_field('body_content');
  $make_h1 = get_sub_field('make_h1');
  $add_class = get_sub_field('add_class');
  $image = get_sub_field('add_image');

  global $first_description;

  if($first_description == '' && $content != ''){
    $first_description = $content;
  }

  echo '<div class="block-container '.$add_class.'" id="block-' . $block_num . '">';
  if(!empty($image)){
    echo '<img src="'.$image.'" >';
  }
  if(!empty($title)){
    if ($make_h1)
      echo '<h1>'.$title.'</h1>';
    else
      echo '<h3>'.$title.'</h3>';
  }
  if(!empty($content))
    echo '<p>'.do_shortcode($content).'</p>';
  echo '</div>';
};

function build_side_by_side($block_num){
  echo '<div class="side-by-side-container"  id="block-' . $block_num . '">';// class="home-slider">';

  // loop through the rows of data
  while ( have_rows('side_by_side_repeater') ) : the_row();

  // display a sub field value
  $image = get_sub_field('side_by_side_image');
  $title = get_sub_field('side_by_side_title');
  $content = get_sub_field('side_by_side_content');
  echo '<div class="side-by-side-element" >';
  if(!empty($title)){
    echo  '<img class="side-by-side-image" src="' . $image . '">';
  }
  echo    '<div class="side-by-side-body" >';
  if(!empty($title)){
    echo    '<h3 class="side-by-side-title">' . $title . '</h3>';
  }
  if(!empty($content)){
    echo    '<p class="side-by-side-content">' . do_shortcode($content) . '</p>';
  }
  echo    '</div>';
  echo '</div>';

  endwhile;

  echo '</div>';
};

function build_split_body_block($block_num){
  $title_left = get_sub_field('left_title');
  $content_left = get_sub_field('left_text');
  $title_right = get_sub_field('right_title');
  $content_right = get_sub_field('right_text');

  echo '<div class="split-block-container" id="block-' . $block_num . '">';

  echo '<div class="split-block split-left">';
  if(!empty($title_left))
    echo '<h4>'.$title_left.'</h4>';
  if(!empty($content_left))
    echo '<div class="block-content">'.$content_left.'</div>';
  echo '</div>';

  echo '<div class="split-block split-right">';
  if(!empty($title_right))
    echo '<h4>'.$title_right.'</h4>';
  if(!empty($content_right))
    echo '<div class="block-content">'.$content_right.'</div>';
  echo '</div>';

  echo '</div>';
};

function build_slider($block_num){
  if( have_rows('slider_slide') ):

      echo '<div class="slider-container flexslider" id="block-' . $block_num . '">';

    // loop through the rows of data
      echo "<ul class='slides'>";

      while ( have_rows('slider_slide') ) : the_row();

        // display a sub field value
        $image = get_sub_field('slider_image');
        $position = get_sub_field('image_position_x');
        $title = get_sub_field('slider_title');
        $content = get_sub_field('slider_content');
        $content_position = get_sub_field('content_position');


        global $first_picture;

        if($first_picture == '' && $image != ''){
          $first_picture = $image;
        }

        if($position != -1){
          $position = 'background-position-x: ' . $position . '%;';
        }else{
          $position = '';
        }


        echo '<li class="slider-slide slider-container" style="background-image: url(\''.$image.'\'); ' . $position .'">';
        
        echo  '<div class="slider-content slider-' . $content_position . '">';
        echo    '<h2>'.$title.'</h2>';
        if(!empty($content)){
          echo    '<p>'.$content.'</p>';
        }
        echo    '</div>';

        echo '</li>';
      endwhile;

      echo '</ul>';

    echo '</div>';

  endif;
};

function build_banner($block_num){

    // display a sub field value
    $image = get_sub_field('banner_image');
    $position = get_sub_field('image_position_x');
    $title = get_sub_field('banner_title');
    $content = get_sub_field('banner_content');
    $content_position = get_sub_field('content_position');


    global $first_picture;

    if($first_picture == '' && $image != ''){
      $first_picture = $image;
    }

    if($position != -1){
      $position = 'background-position-x: ' . $position . '%;';
    }else{
      $position = '';
    }


    echo '<div class="banner-block" id="block-' . $block_num . '" style="background-image: url(\''.$image.'\'); ' . $position .'">';
        
        echo  '<div class="banner-content banner-' . $content_position . '">';
        echo    '<h2>'.$title.'</h2>';
        if(!empty($content)){
          echo    '<p>'.$content.'</p>';
        }
        echo    '</div>';

    echo '</div>';
};


function build_accordian_block($block_num){
  if( have_rows('accordion') ):

      echo '<div class="accordion-block" id="block-' . $block_num . '">';

    
      while ( have_rows('accordion') ) : the_row();

        // display a sub field value
        $title = get_sub_field('accordion_title');
        $text = get_sub_field('accordion_text');

        echo  '<div class="accordion-container">';
        echo    '<div class="accordion-title-container accordion-trigger">';
        echo      '<div class="accordion-title"><h4>' . $title . '</h4><div class="close-button-container"><span class="close-button"></span></div></div>';
        echo    '</div>';
        echo    do_shortcode('<div class="accordion-text-container accordion-content" style="display: none;">'.'<p>' . $text . '</p></div>');
        echo  '</div>';

      endwhile;

    echo '</div>';

  endif;
};

function build_social_links($block_num){

  global $first_picture;
  global $first_description;

  $facebook_link = "https://www.facebook.com/sharer.php?u=https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $twitter_link = 'http://twitter.com/share?url=' . "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $google_plus_link = "https://plus.google.com/share?url=https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $pinterest_link = "http://www.pinterest.com/pin/create/button/?url=https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]&media=".$first_picture."&description=" . $first_description;
  $email_link = "mailto:?subject=" . get_the_title() . "&amp;body=https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $text_message_link = "sms:?body=https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
  $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
  $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");

  if($iPod || $iPhone || $iPad){
    $text_message_link = "sms:&body=https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  } 

  echo '<div class="social-link-wrapper" id="block-' . $block_num . '">';

  //Uncomment below to place share infront of your social links.
  //echo    '<div class="social-link-label">SHARE</div>';

  echo    '<div class="social-link-container">';

  if(get_sub_field('facebook') ){
    echo    '<a href="'.$facebook_link.'" target="_blank"><div class="social-link-button social-link-facebook"></div></a>';
  }

  if(get_sub_field('twitter') ){
    echo    '<a href="'.$twitter_link.'" target="_blank"><div class="social-link-button social-link-twitter"></div></a>';
  }
  
  if(get_sub_field('google_plus') ){
    echo    '<a href="'.$google_plus_link.'" target="_blank"><div class="social-link-button social-link-google"></div></a>';
  }
  
  if(get_sub_field('pinterest') ){
    echo    '<a href="'.$pinterest_link.'" target="_blank"><div class="social-link-button social-link-pinterest"></div></a>';
  }
  
  if(get_sub_field('email') ){
    echo    '<a href="'.$email_link.'"><div class="social-link-button social-link-email"></div></a>';
  }

  if(get_sub_field('text_message') ){
    echo    '<a href="'.$text_message_link.'"><div class="social-link-button social-link-text"></div></a>';
  }

  echo    '</div>';

  echo '</div>';

};

function build_divided_block($block_num){

    $class_name = get_sub_field('container_class_name');

    if( have_rows('divided_element') ):

      echo '<div class="divided-block '.$class_name.'" id="block-' . $block_num . '" >';
      
      while ( have_rows('divided_element') ) : the_row();

        $image = get_sub_field('image');
        $title = get_sub_field('header');
        $content = get_sub_field('content');

        echo '<div class="divided-element">';

        echo    '<div class="divided-element-content">';

        if(!empty($image)){
          echo    '<img src="'.$image.'" >';
        }
        if(!empty($title)){
          if ($make_h1)
            echo  '<h1>'.$title.'</h1>';
          else
            echo  '<h3>'.$title.'</h3>';
        }
        if(!empty($content)){
          echo    '<p>'.do_shortcode($content).'</p>';
        }

        echo    '</div>';

        echo '</div>';

      endwhile;

    echo '</div>';

    endif;

}

function build_start_wrapper(){

  $start_wrapper_class = get_sub_field('class_name');
  if(empty($start_wrapper_class))
    $start_wrapper_class = '';

  $start_wrapper_id = get_sub_field('id_name');
  if(empty($start_wrapper_id))
    $start_wrapper_id = '';


  echo '<div class="block-wrapper ' . get_sub_field('class_name') . '" id="'.$start_wrapper_id.'">';
  echo '<div class="block-wrapper-container">';
}

function build_end_wrapper(){
  echo '</div>';
  echo '</div>';
}