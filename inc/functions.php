<?php

function getThemeDirUrl($dir = null){
	$dir = (empty($dir)) ? dirname(__FILE__) : $dir ;
	preg_match('/\/theme(.*)/i' , $dir , $m);
	$currentPathUrl = content_url() . $m[0];
	return $currentPathUrl;
}

/**
*
* Convert an object to an array
*
* @param     object  $object The object to convert
* @reeturn   array
* @url       http://www.phpro.org/examples/Convert-Object-To-Array-With-PHP.html
*
*/
function objectToArray( $object ) {
    if( !is_object( $object ) && !is_array( $object ) ) {return $object; }
    if( is_object( $object ) ) { $object = get_object_vars( $object ); }
    return array_map( 'objectToArray', $object );
}

/**
*	Function to recursively include all files in a director
**/
function rmFunctionRecurse( $dir = '' ){
	$directory = new RecursiveDirectoryIterator( $dir );
	$iterator = new RecursiveIteratorIterator($directory);
	$Regex = new RegexIterator($iterator, "/\.inc\.php|\.custom\.php/i", RecursiveRegexIterator::MATCH);
	foreach( $Regex as $filepath => $object ):
		include $filepath;
	endforeach;
}
/**
 * Recurses through the 'includes' folder and auto includes files that match the regex '.inc.php'
 * recurse function is in rm-functions.php
 **/
rmFunctionRecurse( __DIR__ );


/**
 * Register template URL and use in js files
 * Use like: background-image: url('+rm_data.templateDirectoryUri+'/images/dd-meet-our-team.jpg)
 */
function rm_data_array(){
	$theme = wp_get_theme();
	$data = array(
		'siteUrl' => rtrim( site_url() , '/') ,
		'themeName'	=> $theme['Template'] ,
		'tmplDirUri' => TMPL_DIR_URI,
	);
	return $data;
}

/**
*	can be used in template parts to include other files within the theme
**/
function get_file_from_theme($file = ''){
	if(file_exists(dirname(__FILE__) .'/' .$file)){
		return dirname(__FILE__) .'/' .$file;
	}
}


/*===========================================================
	CLEAN URI / SLUG [!important]
	# used in  : check_url , bodyClass , check_existence
=============================================================*/
function clean_uri(){
	$ex = preg_replace('(^https?://)', '', get_bloginfo('url') ); // removes 'http(s)' from url
	$ex = preg_replace('/www./i' , '' , $ex ); // remove 'www.' from url
	$output = explode('/' , preg_replace( '(^'.$ex.')' , '' , preg_replace( '/www./i' , '' , $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ) ) ); //clean URI / SLUG
	return $output;
}

/*************
* Get file from image/svg folder
* use like  <?php echo uri_imgs('name-of-image.extension');?>
* can also be used like <?php echo uri_imgs('/sub-headers/img.jpg');?>
* -- wrap link in an <img>
*  <?php echo uri_imgs('name-of-image.extension' , array(true)); ?>
* -- allows svg ( wraps svg in an <img> )
*  example <?php echo uri_imgs('file.svg' , array(true) , '/svg/');?>
*  example <?php echo uri_imgs('../svg/file.svg' , array(true) );?>
*************/
function uri_imgs( $file = null , $args = array() , $alt = ''){
	$folder = '/images/';
	if( isset( $args['folder'] ) && !empty($args['folder'])):
		$folder = $args['folder'];
		unset($args['folder']);
	endif;
	$path = TMPL_DIR . "{$folder}" . $file;
	$path_uri = TMPL_DIR_URI . "{$folder}" . $file;
	if(file_exists( $path ) ):
		if( isset($args[0]) && $args[0] == true):
			$attr = '';
			if( isset( $args['attr'] ) && is_array( $args['attr'] ) && !empty( $args['attr'] ) ):
				$attr = array();
				foreach( $args['attr'] as $key => $val):
					$attr[] = "{$key}=\"{$val}\"";
				endforeach;
				$attr = join(' ', $attr );
			elseif( isset($args[1]) && is_string($args[1])):
				$attr = $args[1];
			endif;

			if(empty($alt)):
				$filename = explode('/', $file);
				$filename = array_reverse($filename);
				$filename = preg_replace('/.[^.]*$/', '',$filename[0]);
				$alt = 'alt="'.$filename.'"';
			else:
				$alt = 'alt="'.$alt.'"';
			endif;

			if( preg_match('/images/i' , $folder ) && !preg_match('/svg/i' , $path ) ):
				$size = getimagesize( $path );
				$width = $size[0];
				$height = $size[1];
				$tag = "<img src=\"{$path_uri}\" width=\"{$width}\" height=\"{$height}\" {$alt} {$attr}>";
			else:
				if( preg_match('/svg/i' , $path ) ):
					$svg_contents = file_get_contents($path);
					$svg = simplexml_load_string($svg_contents);
					$svgattrs = $svg->attributes();
					$_w = rtrim( floor( (string) $svgattrs->width ) , 'px');
					$_h = rtrim( floor( (string) $svgattrs->height ) , 'px');
					if( !empty($_h) && !empty($_w)):
						$tag = "<img src=\"{$path_uri}\"  width=\"{$_w}\" height=\"{$_h}\" {$alt} {$attr}>";
						return $tag;
					endif;
				endif;

				$tag = "<img src=\"{$path_uri}\" {$alt} {$attr}>";
			endif;
			return $tag;
		endif;
	 return $path_uri;
	else:
		return null;
	endif;
}



/*************
* Get URL path
* use like  <?php echo url_path();?>
*************/
function url_path(){
	$path = get_bloginfo('url');
	return $path;
}



/*******************************
Checks to see if a slug is at a certain segment of the URL
check_url update [ruben]  : USES clean_uri()
  #NOTE
    Doesn't require a different index for LIVE / DEV (?)
    -- need to test this on the live to see how it works
    -- working on Live & Dev
*******************************/
function check_url($uri = '', $position = ''){
  $current = array_values( array_filter( clean_uri() ) ); // remove empty arrays at the beginning and end [removes any array that is empty] , then reset the index [0]
  return ( isset($current[$position]) && $current[$position] == $uri ) ? true : false ;
}

/**
 * Check the existence of a particular URL segment
 *
 */
function check_existence($position = '') {
	$current = array_values( array_filter( clean_uri() ) ); // remove empty arrays at the beginning and end [removes any array that is empty] , then reset the index [0]
	if( isset($current[$position]) && $current[$position] != ''):
		return true;
	endif;
}

/*****************
for gallery pages :
page-with-related : checks is parent page has children , checks if child has related pages from parent
page-with-child : checks if page has children
*****************/
function this_is($type = '', $val = ''){
  global $post;
  switch ($type) {
    case 'gallery':
      $output = ( check_url('gallery' , 0) ) ? true : false ;
    break;

    case 'gallery-child':
      $output = ( check_url('gallery' , 0) && check_existence(1) ) ? true : false;
    break;

    case 'gallery-case':
      $output = ( check_url('gallery' , 0) && check_existence(2) ) ? true : false;
    break;

    case 'page-with-child':
      $children = get_pages( array(
          'child_of'  =>  (isset($val))  ? $val : $post->ID
        ));
      $output = ( !empty($children) ) ? true : false;
    break;

    case 'page-with-related':
      $children = get_pages( array(
          'child_of'  =>  (isset($val))  ? $val : ( $post->post_parent ) ? $post->post_parent : $post->ID
        ));
      $output = ( !empty($children) ) ? true : false;
    break;

  }
  return $output;
}


/********************
* Add the slug segments as body classes on inside pages
* last - modified [ruben]
* #note : tested on dev  = Working
* #note : tested on live = Working
* no longer including the ID option
*********************/
function bodyClass( $active_home_id = '' , $home_name = '' , $new_classes = '' , $override = FALSE ) {
	$current = array_values( array_filter( clean_uri() ) ); // remove empty arrays at the beginning and end [removes any array that is empty] , then reset the index [0]
	$home_name =  ( !empty($home_name) ) ? $home_name : 'home';
	global $post;
	$parent_page = ( $post->post_parent ) ? $post->post_parent : $post->ID;

	$classes = array();
	$classes[] = (is_front_page()) ? $home_name : 'inside';

	foreach($current as $slug):
	$classes[] = ($slug != '') ? $slug : '';
	endforeach;
	if( is_page() || is_single() ): $classes[] = get_post_type().'-'.get_the_ID(); endif;
	/* this can also be used for inside page headers css vs php */
	if($parent_page): $classes[] = 'parent-'.$parent_page; endif;
	if( is_404() ): $classes[] = 'page-404'; endif;
	if( get_post_type() == 'post'): $classes[] = 'post from-blog'; else: /*to style everything else but the blog*/ $classes[] = 'not-blog'; endif;
	if( this_is('gallery')): $classes[] = 'rmgallery'; else: /* to style everything else but the rmgallery */ $classes[] = 'not-rmgallery'; endif;
	if( this_is('gallery-child')): $classes[] = 'rmgallery-child'; endif;
	if( is_page() ): $classes[] = 'is-page'; endif;
	global $template,$post;
	$templateType = basename($template , ".php");
	$templateType = 'tmpl_type_' . preg_replace('/(\.|_|-)/i', '_' , $templateType);
	$classes[] = $templateType;
	/*
	for if whatever reason you wanted to include a class / classes from within your own function
	example
	function new_body_classes(){
		// YOUR SUPER SPECIAL CODE HERE
		ob_start();
			echo $class;
		return ob_get_clean();
	}
	bodyClass($active_home_id , $home_name  , $extra_class = 'new_body_classes');

	*/
	if($override == TRUE ){
		$classes = ( is_callable($new_classes) ) ? call_user_func($new_classes , $classes) : '' ;
	}
	else{
		$classes[] = ( is_callable($new_classes) ) ? call_user_func($new_classes , $classes) : '' ; // testing this out
	}


  echo '<body class="'.join(' ' , $classes).' menu-is-closed">';
} /* end */

/**
 * Adds classes to the body tag through the body_class filter
 *
 * @param  array	$classes	Holds the original array of classes
 * @return array				Array with classes added, or the original array passed to the function
 *
 * Note: Because this original only loaded these specific classes,
 * 		 I'm NOT adding the classes from WP that come in the parameter for the function
 * 		 in fear that there could be CSS associated with those WP specific classes
 */
function bodyClass2( $classes ) {

	// Overwriting the parameter, read note in comment block above
	$classes	= array();

	global $template, $post;

	$parent_page = ( $post->post_parent ) ? $post->post_parent : $post->ID;
	// remove empty arrays at the beginning and end [removes any array that is empty] , then reset the index [0]
	$current	= array_values( array_filter( clean_uri() ) );

	$classes[] = ( is_front_page() ) ? 'home' : 'inside';

	foreach ( $current as $slug ) :
		$classes[] = ( $slug != '' ) ? $slug : '';
	endforeach;

	if ( is_page() || is_single() ){ $classes[] = get_post_type().'-'.get_the_ID(); }
	if ( is_page() ) { $classes[] = 'is-page'; }
	// this can also be used for inside page headers css vs php
	if ( $parent_page ) { $classes[] = 'parent-'.$parent_page; }
	if ( is_404() ) { $classes[] = 'page-404'; }
	// to style everything else but the blog
	$classes[]	= ( get_post_type() == 'post' ) ? 'post from-blog' : 'not-blog';
	// to style everything else but the rmgallery
	$classes[]	= ( this_is('gallery') ) ? 'rmgallery' : 'not-rmgallery';
	if ( this_is('gallery-child')) { $classes[] = 'rmgallery-child'; }

	$templateType	= basename( $template , '.php' );
	$menuClass	= 'menu-is-closed';
	$templateType	= 'tmpl_type_' . preg_replace( '/(\.|_|-)/i', '_' , $templateType );
	$classes[]		= $templateType;
	$classes[]		= $menuClass;

	return $classes;
}
add_filter( 'body_class', 'bodyClass2' );


/**
 * Hide the admin bar when logged in
 *
 */
show_admin_bar(false);




/**
 * Custom excerpt length
 *
 */
function custom_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'custom_excerpt_length');

/**
 * Custom excerpt limit
 * Echo like - <?php echo excerpt(120);?>
 *
 */
function excerpt( $limit ) {

	$excerpt = explode( ' ', get_the_excerpt(), $limit );
 	if ( count( $excerpt )>=$limit) {
		array_pop( $excerpt );
		$excerpt = implode(" ", $excerpt ).'...';
	} else {
		$excerpt = implode( " ", $excerpt ). '... <br/>' . '<a class="button" href="'. get_permalink() .'">Read More</a>';
	}
	$excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );

	return $excerpt;
}



