<?php 
function overwrite_wplink(){
	/*
		https://github.com/ffsantos92/rel-nofollow-checkbox
	*/
    global $pagenow;
    $assets = get_template_directory_uri() . '/nofollow';
    if( in_array(get_post_type() , array('post','page'))):
    	if(in_array($pagenow , array('post-new.php','post.php'))):
 			wp_deregister_script('wplink');
    		// Register a new script file to be linked
    		wp_register_script('wplink', $assets . '/js/wp-link.js', array( 'jquery', 'wpdialogs' ), false, 1);
    		wp_localize_script('wplink', 'wpLinkL10n', array('title' => __('Insert/edit link'), 'update' => __('Update'), 'save' => __('Add Link'), 'noTitle' => __('(no title)'), 'noMatchesFound' => __('No matches found.') ));

    	endif;
	endif;
    // Disable wplink
}
add_action('admin_enqueue_scripts', 'overwrite_wplink', 999);