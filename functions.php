<?php if ( !defined('ABSPATH') ) die();


define( 'FS_THEME_DIR', get_template_directory() );
define( 'FS_THEME_URL', get_template_directory_uri() );


// ------------------------
// Theme Setup
// ------------------------

if ( ! isset( $content_width ) )
	$content_width = 2048;


if ( ! function_exists( 'fs_blocks_setup' ) ) :

function fs_blocks_setup() {
	
	
	// I18n
	
	load_theme_textdomain( 'fs-blocks', FS_THEME_DIR . '/languages' );
	
	
	// Theme Support
	
	add_editor_style( array('css/editor-style.css') );
	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );
	

	// Gutenberg support 
	
	add_theme_support( 'align-wide' );
	
	add_theme_support( 'editor-color-palette', array(
	    array(
	        'name' => esc_html__( 'Primary color', 'fs-blocks' ),
	        'slug' => 'primary-color',
	        'color' => get_theme_mod('primary_color', '#9c0'),
	    ),
	    array(
	        'name' => esc_html__( 'Secondary color', 'fs-blocks' ),
	        'slug' => 'secondary-color',
	        'color' => get_theme_mod('secondary_color', '#606060'),
	    ),
	));	
	
	add_theme_support( 'disable-custom-colors' );

}
endif;
add_action( 'after_setup_theme', 'fs_blocks_setup' );


// Gutenberg editor styles

function fs_blocks_block_editor_styles() {
    wp_enqueue_style( 
    	'fs_blocks_block_editor_styles',
    	get_theme_file_uri( '/block-editor-style.css' ), 
    	false, 
    	'1.0', 
    	'screen'
    );
}
add_action( 'enqueue_block_editor_assets', 'fs_blocks_block_editor_styles' );


// ------------------------
// Enqueue JS & CSS
// ------------------------

function fs_blocks_scripts_load() {
    if (!is_admin()) {

		
		// JS 
		
		wp_deregister_script( 'jquery' );

		wp_enqueue_script(
			'jquery', 
			FS_THEME_URL . '/js/jquery-3.3.1.min.js', 
			array(), 
			'3.3.1', 
			true
		);


		if ( get_theme_mod('onepage') == true ) {
			
			wp_enqueue_script(
				'onepage-scroll', 
				FS_THEME_URL . '/js/onepage-scroll.js', 
				array(), 
				false, 
				true
			);
			
		}

		
		// Fancybox
		
		wp_enqueue_script(
			'fancybox', 
			FS_THEME_URL . '/js/jquery.fancybox.min.js', 
			array('jquery'), 
			false, 
			true
		);
		wp_enqueue_script(
			'fancybox-init', 
			FS_THEME_URL . '/js/fancybox-init.js', 
			array('fancybox'), 
			false, 
			true
		);

		
		// Scroll-Out
		
		wp_enqueue_script(
			'scrollout', 
			FS_THEME_URL . '/js/scroll-out.min.js', 
			array(), 
			'2.2.3', 
			true
		);

		function fs_scrollout_js() {
			print '
			<script>
				ScrollOut({
				  
				});
			</script>
			';
		}
		add_action('wp_footer', 'fs_scrollout_js', 100);
				
		
		// Main
		
		wp_enqueue_script(
			'focus-visible', 
			FS_THEME_URL . '/js/focus-visible.js', 
			array(), 
			false, 
			true
		);
		
		wp_enqueue_script(
			'fs-blocks-skip-link-focus-fix', 
			FS_THEME_URL . '/js/skip-link-focus-fix.js', 
			array(), 
			false, 
			true
		);
		
	    wp_enqueue_script( 
	    	'main', 
	    	FS_THEME_URL . '/js/main.js',
	    	array('jquery'), 
	    	'1.0', 
	    	true
	    );
	    
	    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		
		// CSS
		
		wp_enqueue_style( 
			'fancybox', 
			FS_THEME_URL . '/css/jquery.fancybox.min.css',
			array(), 
			false, 
			'screen' 
		);
		
		
		
		// Main stylesheet
		
		wp_enqueue_style( 'fs-blocks-style', get_stylesheet_uri() );

	}
}    
add_action( 'wp_enqueue_scripts', 'fs_blocks_scripts_load' );


// ------------------------
// Theme Stuff
// ------------------------


// Customizer

require FS_THEME_DIR . '/inc/customizer.php';


// Menus

register_nav_menus( array(
	'main_menu' =>  esc_html__( 'Main Menu', 'fs-blocks' ),
	'footer_menu' => esc_html__( 'Footer Menu', 'fs-blocks' )
));


// Sub-menus Walker

include_once( dirname( __FILE__ ) . '/inc/subnav-walker.php' );


// Extended Search

include_once( dirname( __FILE__ ) . '/inc/fs-extended-search.php' );


// Bg image

function fs_bg_img() {
	
	if ( '' != get_the_post_thumbnail() ) {
		$img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large-hd' );
		$bg = ' style="background-image: url('.$img_url[0].')"';
	} else {
		$bg = null;	
	}
	
	echo $bg;
}

// The slug

function the_slug($echo=true) {
  
  $slug = basename(get_permalink());
  	do_action('before_slug', $slug);
  
  $slug = apply_filters('slug_filter', $slug);
  	
  	if( $echo ) echo $slug;
  		do_action('after_slug', $slug);
  	
  return $slug;
}

// Image Sizes

add_image_size( 'thumbnail-hd', 320, 320, true );
add_image_size( 'medium-hd', 640, 640, false );
add_image_size( 'large-hd', 2048, 2048, false );

add_filter( 'image_size_names_choose', 'fs_blocks_custom_sizes' );
function fs_blocks_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'thumbnail-hd'	=> __( 'Thumbnail High', 'fs-blocks' ),
        'medium-hd'		=> __( 'Medium High', 'fs-blocks' ),
        'large-hd'		=> __( 'Large High', 'fs-blocks' ),
    ) );
}

// Widgets

function fs_blocks_widgets_init() {
	register_sidebar(array(
		'name'			=>	esc_html__( 'Primary Widgets Area', 'fs-blocks' ),
		'id'			=>	'widgets_area1',
		'description' 	=> 	'',
		'before_widget' => 	'<div id="%1$s" class="widget-container %2$s">',
		'after_widget' 	=> 	'</div>',
		'before_title' 	=> 	'<p class="widget-title">',
		'after_title' 	=> 	'</p>',
	));
}
add_action( 'widgets_init', 'fs_blocks_widgets_init' );


// Tinymce class

function fs_blocks_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'fs_blocks_mce_buttons_2');

function fs_blocks_tiny_formats($init_array) {

    $style_formats = array(

        array(
            'title' => 'Texte intro',
            'selector' => 'p',
            'classes' => 'text-intro',
            'wrapper' => true,
        ),
        array(
            'title' => 'Texte mentions',
            'selector' => 'p',
            'classes' => 'text-mentions',
            'wrapper' => true,
        ),
        array(
            'title' => 'Bouton d’action',
            'selector' => 'a',
            'classes' => 'action-btn',
        )
    );
    $init_array['style_formats'] = json_encode($style_formats);

    return $init_array;

}
add_filter('tiny_mce_before_init', 'fs_blocks_tiny_formats');


// Custom search form

function fs_blocks_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
    <input type="search" placeholder="' . __( 'Keywords' ) . '" value="' . get_search_query() . '" name="s" id="s">
    <input type="submit" class="action-btn" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'">
    </form>';
 
    return $form;
}
add_filter( 'get_search_form', 'fs_blocks_search_form' );




// ------------------------
// Auto-Updater
// ------------------------

// Remove these lines and dependencies for your theme

require 'inc/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/anybodesign/fs-blocks',
	__FILE__,
	'fs-blocks'
);
$myUpdateChecker->setBranch('master');