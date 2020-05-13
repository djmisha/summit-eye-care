<?php

/*==================================================
=            Define Template Directory             =
==================================================*/

if( !defined('TMPL_DIR')):
	define('TMPL_DIR' , get_template_directory() );
endif;

if( !defined('TMPL_DIR_URI')):
	define('TMPL_DIR_URI' , get_template_directory_uri() );
endif;


/*===================================
=            THEME SETUP            =
===================================*/

include TMPL_DIR . '/inc/functions.php';  //Inclide  Functions in inc/functions.php (must be included before anything else)
// include TMPL_DIR . '/pagebuilder/pb-acf-styles.php';  //Inclide  Functions in inc/functions.php (must be included before anything else)

// Nav Walker
// if(file_exists(TMPL_DIR . '/inc/walkers/walkerpagecustom.php')):
// 	include TMPL_DIR . '/inc/walkers/walkerpagecustom.php';
// endif;


function __themesetup(){
	add_theme_support('post-thumbnails'); // Add thumbnail functionality
}

add_action( 'after_setup_theme', '__themesetup' , 2 );

/*==================================
=            Theme CSS             =
==================================*/

function __themecss(){

	wp_register_style( 'owl' , TMPL_DIR_URI . '/js/libs/owl-carousel/assets/owl.carousel.css');
	wp_register_style( 'fancybox' , TMPL_DIR_URI . '/js/libs/fancybox3/jquery.fancybox.css');
	wp_register_style( 'fontawesome' , TMPL_DIR_URI . '/fonts/fontawesome/css/all.css' );
	wp_register_style( 'silvr-theme' , get_stylesheet_uri() , array('owl' , 'fancybox' , 'fontawesome') , '1' );

	wp_enqueue_style( 'silvr-theme' );

}
add_action('wp_enqueue_scripts','__themecss');

/*=========================================
=            Theme Javascripts            =
=========================================*/

function __themejs(){
	global $wp_scripts;
	//Required
	wp_deregister_script('jquery');
	wp_deregister_script( 'wp-embed' ); // Disable wp-embed.js

	wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js", false, "3.4.1", true);
	wp_register_script( 'modernizr', TMPL_DIR_URI . '/js/libs/modernizr.min.js', false, '2.8.3', false );
	//Optional
	// wp_register_script('silvr-cookie', TMPL_DIR_URI . '/js/libs/jquery.cookie.min.js', array('jquery','modernizr'), '1.0', true );
	wp_register_script('silvr-blazy', TMPL_DIR_URI . '/js/libs/blazy/blazy.js', array('jquery','modernizr'), '1.0', true );
	wp_register_script('silvr-blazy-polyfill', TMPL_DIR_URI . '/js/libs/blazy/polyfills/closest.js', array('jquery','modernizr'), '1.0', true );
	wp_register_script('silvr-fancybox', TMPL_DIR_URI . '/js/libs/fancybox3/jquery.fancybox.min.js', array('jquery','modernizr'), '1.0', true );
	wp_register_script('silvr-match', TMPL_DIR_URI . '/js/libs/match-height/jquery.matchHeight-min.js', array('jquery','modernizr'), '1.0', true );
	wp_register_script('silvr-owl', TMPL_DIR_URI . '/js/libs/owl-carousel/owl.carousel.js', array('jquery','modernizr'), '1.0', true );

	wp_register_script('silvr-wow', TMPL_DIR_URI . '/js/libs/wow/wow.min.js', array('jquery','modernizr'), '1.0', true );
	// wp_register_script('silvr-harvey', TMPL_DIR_URI . '/js/libs/harvey.min.js', array('jquery','modernizr'), '1.0', true );
	//RM Scripts
	wp_register_script('theme-js', TMPL_DIR_URI . '/js/scripts.js', array('jquery','modernizr'), '1.0', true );


	$data_array = rm_data_array();
	wp_localize_script( $handle = 'theme-js', $object_name = 'rm_data', $l10n = $data_array ); //found in rm-functions.php
	wp_enqueue_script( 'rm_js_data' );


	//Enqueue All Scripts
	//Enqueue Required
	wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'rm_modernizr');
	//Enqueue Optional
	// wp_enqueue_script( 'silvr-cookie');
	// wp_enqueue_script( 'silvr-blazy');
	// wp_enqueue_script( 'silvr-blazy-polyfill');
	// wp_enqueue_script( 'silvr-fancybox');
	// wp_enqueue_script( 'silvr-match');
	wp_enqueue_script( 'silvr-owl');
	// wp_enqueue_script( 'silvr-wow');
	// wp_enqueue_script( 'silvr-harvey');
	//Enqueue RM Scripts
	// wp_enqueue_script( 'silvr-menu');
	wp_enqueue_script( 'theme-js');
}
add_action('wp_enqueue_scripts','__themejs');

/*******************************************
		Activated only when going live
*******************************************/

// add_filter('inline/css' , function($tag = null ,$handle = null ,$src = null){

// 	$newtag = '';
// 	if($_SERVER['HTTP_HOST'] != 'something.com'):
// 		/*
// 			RUN ONLY ON LIVE (not dev)
// 		*/

// 		$templatepath = get_template_directory_uri();
// 		if(in_array($handle , array('silvr-theme' , 'fancybox' , 'owl' , 'fontawesome')))://list the styles you want to target
// 			$templatepath2 = preg_replace('/https?:\/\//i' , '' , $templatepath);
// 			$src2 = preg_replace('/https?:\/\/|\?(.*)/i','',$src);
// 			$src2 = str_replace("$templatepath2", '' , $src2 );
// 			$newtag = miniCSS::file( $src2 , array('echo'=>false));
// 		endif;

// 	endif;
// 	if(!empty($newtag)): return $newtag; endif;
// 	return $tag;
// },1,3);

// /* Defer Modernir Load for Site Speed */

// add_filter('script_loader_tag', 'add_defer_attribute', 11, 2);
// function add_defer_attribute($tag, $handle) {
//     if ( 'modernizr' !== $handle )
//         return $tag;
//     return str_replace( ' src', ' defer="defer" src', $tag );
// }

// /* INLINE JS */
// add_filter('removefromurl/protocol' , function($url = ''){
// 	$url = preg_replace('(^https?://)', '', $url ); // removes protocol
// 	return $url;
// },10,1);
// add_filter('removefromurl/query' , function($url = ''){
// 	$url = preg_replace('/\?.*/', '', $url); //removes query
// 	return $url;
// },10,1);
// add_filter('removefromurl/www' , function($url = ''){
// 	$url = preg_replace('/www./i' , '' , $url ); // removes 'www.' from url
// 	return $url;
// },10,1);
// add_filter('removefromurl/protocol-www' , function($url = ''){
// 	$url = preg_replace('(^https?://)', '', $url ); // removes protocol
// 	$url = preg_replace('/www./i' , '' , $url ); // removes www
// 	return $url;
// },10,1);
// add_filter('removefromurl/protocol-www-query' , function($url = ''){
// 	$url = preg_replace('(^https?://)', '', $url ); // removes protocol
// 	$url = preg_replace('/www./i' , '' , $url ); // removes wwww
// 	$url = preg_replace('/\?.*/', '', $url); //removes query
// 	return $url;
// },10,1);
// add_filter('script_loader_tag' , function( $tag , $handle , $src ){
// 	global $wp_version;
// 	if($wp_version >= '4.1.0'):
// 		if(!preg_match('/<!--/i' , $tag )):
// 				$homeurl  = apply_filters('removefromurl/protocol-www' , home_url() );
// 				$cleansrc = apply_filters('removefromurl/protocol-www-query' , $src );
// 				$regexurl = preg_replace('/\//i' , '\/' , $homeurl );
// 				if(preg_match("/$regexurl/" , $cleansrc )):
// 					$cleansrc = preg_replace("/$regexurl/" , '' , $cleansrc );
// 					$filepath = rtrim(ABSPATH , '/') .'/'. ltrim($cleansrc , '/');
// 					if(file_exists($filepath)):
// 						/*
// 							rm_cookie , rm_scripts
// 						*/
// 						if(in_array( $handle , array('rm_scripts'))):
// 							$filecontents = file_get_contents($filepath);
// 							$newtag = "<script class=\"inlinejs_{$handle}\">{$filecontents}</script>";
// 							return $newtag;
// 						endif;

// 					endif;
// 				endif;
// 			return $tag;
// 		endif;
// 	endif;
// 	return $tag;
// }, 100 , 3);



/*======================================================================
=            Theme Options Page for Advanced Custom Fields             =
======================================================================*/

$siteName = get_bloginfo('name') . ' Settings';

if( function_exists('acf_add_options_page') ) {

	$page = acf_add_options_page(array(
		'page_title' 	=> $siteName,
		'menu_title' 	=> $siteName,
		'menu_slug' 	=> 'theme-general-settings',
		'capability' 	=> 'edit_posts',
		'redirect' 	=> false,
		'icon_url' => 'dashicons-admin-customizer'
	));

}

/*==================================
=            Inline SVG            =
==================================*/

function inline_svg($name) {
	$file = get_template_directory();
	$file .= "/images/svg/" . $name . ".svg";
	return file_get_contents($file);
}

/*=========================================
=            Is Page or Parent            =
=========================================*/

function is_tree($pid) {
	global $post;
	if(is_page()&&($post->post_parent==$pid||is_page($pid)))
		return true;
	else
		return false;
};


/*==========================================
=            Site Logo Function            =
==========================================*/

// To use, call the function with the filename only (e.g. logo.svg, or site-logo.png);

function site_logo($filename) {
	// Just setting an array of image file types that are not SVG. SVGs will display inline in the code. Bitmaps will be included in an image tag.
	$bitmap = array('jpg', 'png', 'gif');

	// Separating filename into name and extension

	$pieces = explode('.', $filename);
	$logoName = $pieces[0];
	$extension = $pieces[1];


	// We are checking to see if the first argument is an SVG or a bitmap image
	if( $extension == 'svg' ) {
		// This is an SVG image so we're inlining it.
		$output = inline_svg($logoName);
	}
	elseif( in_array($extension, $bitmap) ) {
		// This is a bitmap image, so it will be in an <img> tag.
		$templateDirectory = get_bloginfo( 'template_directory' );
		$siteTitle = get_bloginfo( 'name' );
		$output = '<img src="' . $templateDirectory . '/images/' . $logoName . '.' . $extension .'" alt="' . $siteTitle . '">';
	}
	else {

	}

	$siteDir = get_bloginfo( 'url' );
	if ( is_front_page() ) {
		echo '<h1 class="site-logo"><a href="' . $siteDir . '">' . $output . '</a></h1>';
	}
	else {
		echo '<div class="site-logo"><a href="' . $siteDir . '">' . $output . '</a></div>';
	}
}



/*=============================================
=            Header Image Function            =
=============================================*/

function header_images() {
	if(!is_front_page()) {

		$x = "";
		$rows = get_field('header_sections', 'option');
		if($rows) {
			foreach($rows as $row) {
				if(this_is('gallery')) {
					if (get_the_ID($row['page_parent'])) {
						$x = $row['header_images'];
					}
				}
				elseif (is_tree($row['page_parent'])) {
					$x = $row['header_images'];
					// $patient = $row['actual_patient'];
				}
			}
		}


		if($x >= 1) {

			echo 'data-parent="' . $row['page_parent'] .'" ';

			$randImage	= '';

			$repeater		= $x;
			$rand				= rand( 0, ( count($repeater) - 1 ) );
			$randImage	= $repeater[$rand]['image'];
			$patient 		= $repeater[$rand]['actual_patient'];

			echo 'style="background-image:url(' . $randImage . ')"';
			echo 'data-patient="' . $patient . '"';
			echo 'data-patient="' . $randImage . '"';
		}
		else {
			$defaultRandImage	= '';
			if ( !empty( get_field( 'default_images' , 'option' ) ) ) {
				$defaultRepeater		= get_field( 'default_images' , 'option' );
				$defaultRand				= rand( 0, ( count($defaultRepeater) - 1 ) );
				$defaultRandImage		= $defaultRepeater[$defaultRand]['image'];
		// $defaultPatient			= $defaultRepeater[$defaultRand]['actual_patient'];
			}
			echo 'style="background-image:url(' . $defaultRandImage . ')" ';
			// $directParent = $post->post_parent;
			// echo 'data-ID="' . $directParent . '"';
		}
	}
}


/*=============================================
=            custom excerpt length            =
=============================================*/

function my_excerpt($excerpt_length = 55, $id = false, $echo = true) {

		$text = '';

		if($id) {
			$the_post = & get_post( $my_id = $id );
			$text = ($the_post->post_excerpt) ? $the_post->post_excerpt : $the_post->post_content;
		} else {
			global $post;
			$text = ($post->post_excerpt) ? $post->post_excerpt : get_the_content('');
		}

		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
		$text = strip_tags($text);

		$excerpt_more = ' ' . '[...]';
		$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
		if ( count($words) > $excerpt_length ) {
			array_pop($words);
			$text = implode(' ', $words);
			$text = $text . $excerpt_more;
		} else {
			$text = implode(' ', $words);
		}
	if($echo)
	echo apply_filters('the_content', $text);
	else
	return $text;
}

function get_my_excerpt($excerpt_length = 55, $id = false, $echo = false) {
 return my_excerpt($excerpt_length, $id, $echo);
}


/*=========================================
=            Sitemap ShortCode            =
=========================================*/

// [sitemap omit="1051,432"]
function sitemap_function( $atts ){
ob_start();  ?>

<ul>
    <?php wp_list_pages(
		array(
		 'title_li' => '',
		 'exclude' => $atts['omit'],
		 'depth' => $atts['depth']
	 ) ); ?>
</ul>
<?php
$sitemap = ob_get_clean();
return $sitemap;
}
add_shortcode( 'sitemap', 'sitemap_function' );



/*=========================================
=            Nav Menu Dropdown            =
=========================================*/

function custom_start_el( $item_output, $item, $depth, $args ) {

	if ( $args->menu_id == 'menu-main' && in_array( 'menu-item-has-children', $item->classes ) ) {
		$item_output = $item_output .'<div class="nav-dropdown-button"><div class="nav-expander"><span></span><span></span></div></div>';
	}

	return $item_output;

}
add_filter( 'walker_nav_menu_start_el', 'custom_start_el', 10, 4 );

add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2 );

function my_wp_nav_menu_objects( $items, $args ) {

	// loop
	foreach( $items as &$item ) {

		// vars
		$duplicate = get_field('duplicate', $item);

		// append duplicate
		if ( !empty( $duplicate ) ) {
			$item->classes[]	= 'duplicate-item';
		}

	}


	// return
	return $items;

}

/*==========================================================
=            Disable the WordPress Core Emoji's            =
==========================================================*/

function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}

add_action( 'init', 'disable_emojis' );


/*===========================================================
=            Exclude pages from Wordpress Search            =
===========================================================*/

if (!is_admin()) {
	function wpb_search_filter($query) {
		if ($query->is_search) {
			$query->set('post_type', 'post');
		}
		return $query;
	}
	add_filter('pre_get_posts','wpb_search_filter');
}




/*==================================================
=            Display Last Publish Date             =
==================================================*/


function wpb_last_updated_date( $content ) {
$u_time = get_the_time('U'); 
$u_modified_time = get_the_modified_time('U'); 
if ($u_modified_time >= $u_time + 86400) { 
$updated_date = get_the_modified_time('F jS, Y');
$updated_time = get_the_modified_time('h:i a'); 
$custom_content .= '<p class="last-updated">Last updated: <span>'. $updated_date . '</span></p>';  
} 
 
    $custom_content .= $content;
    return $custom_content;
}

add_filter( 'the_content', 'wpb_last_updated_date' );