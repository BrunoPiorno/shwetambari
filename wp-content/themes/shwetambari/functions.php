<?php

if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentysixteen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * Create your own twentysixteen_setup() function to override in a child theme.
	 *
	 * @since Twenty Sixteen 1.0
	 */
	function twentysixteen_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
		 * If you're building a theme based on Twenty Sixteen, use a find and replace
		 * to change 'twentysixteen' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'twentysixteen' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'twentysixteen' ),
			//	'social'  => __( 'Social Links Menu', 'twentysixteen' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

	}
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'twentysixteen_setup' );



/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Sixteen 1.6
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function twentysixteen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentysixteen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentysixteen_resource_hints', 10, 2 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'twentysixteen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar( array(
		'name'          => __( 'Header Search', 'twentysixteen' ),
		'id'            => 'header_search',
		'description'   => __( 'Header Search', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );

if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :
	/**
	 * Register Google fonts for Twenty Sixteen.
	 *
	 * Create your own twentysixteen_fonts_url() function to override in a child theme.
	 *
	 * @since Twenty Sixteen 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function twentysixteen_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';


		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family' => urlencode( implode( '|', $fonts ) ),
					'subset' => urlencode( $subsets ),
				),
				'https://fonts.googleapis.com/css'
			);
		}

		return $fonts_url;
	}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	//wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'twentysixteen-style', get_stylesheet_uri() );

	// Theme block stylesheet.
	//wp_enqueue_style( 'twentysixteen-block-style', get_template_directory_uri() . '/css/blocks.css', array( 'twentysixteen-style' ), '20181230' );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );

	//wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );
	//wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array(), '', true );
	if(!is_home() && !is_front_page()):
		wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.0.10/css/all.css');
		//wp_enqueue_style( 'line-awesome', 'https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css');
		//wp_enqueue_style( 'owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css',true);
		//wp_enqueue_script( 'owl-carousel','https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', '', '', true );
		//wp_enqueue_script( 'fancybox','https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', '', '', true );
		//wp_enqueue_script( 'aos','https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js', '', '', true );
		//wp_enqueue_style( 'aos', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css',true);
		//wp_enqueue_style( 'fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css');

	endif;
	wp_enqueue_style( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css',true);
	wp_enqueue_script( 'slick','https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', '', '', true );

	wp_enqueue_script( 'match-height','https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js', '', '', true );
	

	//wp_enqueue_style( 'animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css');
	//wp_enqueue_script( 'parallax',get_template_directory_uri() . '/js/parallax.js', '', '', true );
	//wp_enqueue_script( 'loaded','https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.4/imagesloaded.pkgd.min.js', '', '', true );
	wp_enqueue_script( 'theme-functions',get_template_directory_uri() . '/js/functions-shwetambari.js', '', '', true );

	wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20181230', true );

	wp_localize_script(
		'twentysixteen-script',
		'screenReaderText',
		array(
			'expand'   => __( 'expand child menu', 'twentysixteen' ),
			'collapse' => __( 'collapse child menu', 'twentysixteen' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

// shwetambari

function gf_make_submit_input_into_a_button_element($button_input, $form) {

  //save attribute string to $button_match[1]
  preg_match("/<input([^\/>]*)(\s\/)*>/", $button_input, $button_match);

  //remove value attribute
  $button_atts = str_replace("value='".$form['button']['text']."' ", "", $button_match[1]);

  return '<button '.$button_atts.'>'.$form['button']['text'].' <span class="arrow"></span></button>';
}
add_filter('gform_submit_button', 'gf_make_submit_input_into_a_button_element', 10, 2);

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();

	acf_add_options_sub_page('General');

}

function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );