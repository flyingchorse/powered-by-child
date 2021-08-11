<?php
/**
 * @package WordPress
 * @subpackage Powered By
 */

/**
 * Make theme available for translation
 * Translations can be filed in the /languages/ directory
 * If you're building a theme based on toolbox, use a find and replace
 * to change 'powered-by' to the name of your theme in all the template files
 */

function powered_by_create_post_type() {
	register_post_type( 'pb_tps_reports', array(
			'labels' => array(
				'name' => __( 'Testimonials', 'powered-by' ),
				'add_new_item' => __( 'Add New Testimonial', 'powered-by' ),
			),
			'public' => true,
			'supports' => array( 'title', 'editor', 'author' )
		) );
}
add_action( 'init', 'powered_by_create_post_type' );

/**
 * Register a custom taxonomy for our TPS Reports
 */
register_taxonomy(
	'hometestimonial',
	'pb_tps_reports',
	array(
		'labels' => array(
			'name' => _x( 'Home Page', 'powered-by' ),
			),
	)
);


function powered_by_testimonial_term() {
	wp_insert_term(
		'Hometestimonial',
		'hometestimonial'
	);
}
add_action( 'after_setup_theme', 'powered_by_testimonial_term' );

/**
 * Add a custom meta box for the Featured Page taxonomy
 */
function powered_by_add_meta_mof() {
	add_meta_box(
		'powered-by-testimonial',
		__( 'Testimonial Page', 'powered-by' ),
		'powered_by_create_testi_meta_box',
		'pb_tps_reports',
		'side',
		'core'
	);
}
add_action( 'add_meta_boxes', 'powered_by_add_meta_mof' );

/**
 * Create a custom meta box for the Featured Page taxonomy
 */
function powered_by_create_testi_meta_box( $post ) {
	
	// Use nonce for verification
  	wp_nonce_field( 'powered_by_testimonial_post', 'powered_by_testimonial_post_nonce' );

	// Retrieve the metadata values if the exist
	$use_as_feature = get_post_meta( $post->ID, '_use_as_feature', true );
	
	?>
		<label for="use_as_feature">
			<input type="checkbox" name="use_as_feature" id="use_as_feature" <?php checked( 'on', $use_as_feature ); ?> />
			<?php printf( __( 'Feature on the %1$s front page', 'powered-by' ), '<em>' . get_bloginfo( 'title' ) . '</em>' ); ?>
		</label>
	<?php
}

/**
 * Save the Featured Page meta box data
 */
function powered_by_save_meta_box_data_testi( $post_id ) {

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( ! wp_verify_nonce( $_POST['powered_by_testimonial_post_nonce'], 'powered_by_testimonial_post' ) )
		return $post_id;

	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return $post_id;
		
	// Check permissions
	if ( 'pb_tps_reports' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) )
			return $post_id;
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}

	// OK, we're authenticated: we need to find and save the data

	// Update use_as_feature value, default is off
	$use_as_feature = isset( $_POST['use_as_feature'] ) ? $_POST['use_as_feature'] : 'off';
	update_post_meta( $post_id, '_use_as_feature', $use_as_feature ); // Save the data

	if ( 'on' == $use_as_feature ) {
		// Add the Featured term to this post
		wp_set_object_terms( $post_id, 'Hometestimonial', 'hometestimonial' );
	} elseif ( 'off' == $use_as_feature ) {
		// Let's not use that term then
		wp_delete_object_term_relationships( $post_id, 'hometestimonial' );
	}
		
}
add_action( 'save_post', 'powered_by_save_meta_box_data_testi' );

/*

Custom Post type for home page items.

*/

register_taxonomy(
	'homebody',
	'page',
	array(
		'labels' => array(
			'name' => _x( 'homebody', 'powered-by' ),
		),
		'public' => false,
	)
);

/**
 * Set a default term for the homebody Page taxonomy
 */
function powered_by_homebody_term() {
	wp_insert_term(
		'Homebody',
		'homebody'
	);
}
add_action( 'after_setup_theme', 'powered_by_homebody_term' );

/**
 * Add a custom meta box for the homebody Page taxonomy
 */
function powered_by_add_meta_moh() {
	add_meta_box(
		'powered-by-homebody',
		__( 'homebody Page', 'powered-by' ),
		'powered_by_create_meta_box_homebody',
		'page',
		'side',
		'core'
	);
}
add_action( 'add_meta_boxes', 'powered_by_add_meta_moh' );

/**
 * Create a custom meta box for the homebody Page taxonomy
 */
function powered_by_create_meta_box_homebody( $post ) {
	
	// Use nonce for verification
  	wp_nonce_field( 'powered_by_homebody_page', 'powered_by_homebody_page_nonce' );

	// Retrieve the metadata values if the exist
	$use_as_homebody = get_post_meta( $post->ID, '_use_as_homebody', true );
	
	?>
		<label for="use_as_homebody">
			<input type="checkbox" name="use_as_homebody" id="use_as_homebody" <?php checked( 'on', $use_as_homebody ); ?> />
			<?php printf( __( 'Feature on the %1$s front page', 'powered-by' ), '<em>' . get_bloginfo( 'title' ) . '</em>' ); ?>
		</label>
	<?php
}

/**
 * Save the homebody Page meta box data
 */
function powered_by_save_meta_box_data_homebody( $post_id ) {

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( ! wp_verify_nonce( $_POST['powered_by_homebody_page_nonce'], 'powered_by_homebody_page' ) )
		return $post_id;

	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return $post_id;
		
	// Check permissions
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) )
			return $post_id;
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}

	// OK, we're authenticated: we need to find and save the data

	// Update use_as_homebody value, default is off
	$use_as_homebody = isset( $_POST['use_as_homebody'] ) ? $_POST['use_as_homebody'] : 'off';
	update_post_meta( $post_id, '_use_as_homebody', $use_as_homebody ); // Save the data

	if ( 'on' == $use_as_homebody ) {
		// Add the homebody term to this post
		wp_set_object_terms( $post_id, 'Homebody', 'homebody' );
	} elseif ( 'off' == $use_as_homebody ) {
		// Let's not use that term then
		wp_delete_object_term_relationships( $post_id, 'homebody' );
	}
		
}
add_action( 'save_post', 'powered_by_save_meta_box_data_homebody' );


/*

Add footerone custom Taxonomy

*/

register_taxonomy(
	'footerone',
	'page',
	array(
		'labels' => array(
			'name' => _x( 'footerone', 'powered-by' ),
		),
		'public' => false,
	)
);



function powered_by_footerone_term() {
	wp_insert_term(
		'footerone',
		'footerone'
	);
}
add_action( 'after_setup_theme', 'powered_by_footerone_term' );

/**
 * Add a custom meta box for the footerone Page taxonomy
 */
function powered_by_add_meta_footerone() {
	add_meta_box(
		'powered-by-footerone',
		__( 'footerone Page', 'powered-by' ),
		'powered_by_create_meta_box_footerone',
		'page',
		'side',
		'core'
	);
}
add_action( 'add_meta_boxes', 'powered_by_add_meta_footerone' );

/**
 * Create a custom meta box for the footerone Page taxonomy
 */
function powered_by_create_meta_box_footerone( $post ) {
	
	// Use nonce for verification
  	wp_nonce_field( 'powered_by_footerone_page', 'powered_by_footerone_page_nonce' );

	// Retrieve the metadata values if the exist
	$use_as_footerone = get_post_meta( $post->ID, '_use_as_footerone', true );
	
	?>
		<label for="use_as_footerone">
			<input type="checkbox" name="use_as_footerone" id="use_as_footerone" <?php checked( 'on', $use_as_footerone ); ?> />
			<?php printf( __( 'Feature on the %1$s front page', 'powered-by' ), '<em>' . get_bloginfo( 'title' ) . '</em>' ); ?>
		</label>
	<?php
}

/**
 * Save the footerone Page meta box data
 */
function powered_by_save_meta_box_data_footerone( $post_id ) {

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( ! wp_verify_nonce( $_POST['powered_by_footerone_page_nonce'], 'powered_by_footerone_page' ) )
		return $post_id;

	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return $post_id;
		
	// Check permissions
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) )
			return $post_id;
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}

	// OK, we're authenticated: we need to find and save the data

	// Update use_as_footerone value, default is off
	$use_as_footerone = isset( $_POST['use_as_footerone'] ) ? $_POST['use_as_footerone'] : 'off';
	update_post_meta( $post_id, '_use_as_footerone', $use_as_footerone ); // Save the data

	if ( 'on' == $use_as_footerone ) {
		// Add the footerone term to this post
		wp_set_object_terms( $post_id, 'footerone', 'footerone' );
	} elseif ( 'off' == $use_as_footerone ) {
		// Let's not use that term then
		wp_delete_object_term_relationships( $post_id, 'footerone' );
	}
		
}
add_action( 'save_post', 'powered_by_save_meta_box_data_footerone' );

/*
Add footertwo custom Taxonomy

*/

register_taxonomy(
	'footertwo',
	'page',
	array(
		'labels' => array(
			'name' => _x( 'footertwo', 'powered-by' ),
		),
		'public' => false,
	)
);



function powered_by_footertwo_term() {
	wp_insert_term(
		'footertwo',
		'footertwo'
	);
}
add_action( 'after_setup_theme', 'powered_by_footertwo_term' );

/**
 * Add a custom meta box for the footertwo Page taxonomy
 */
function powered_by_add_meta_footertwo() {
	add_meta_box(
		'powered-by-footertwo',
		__( 'footertwo Page', 'powered-by' ),
		'powered_by_create_meta_box_footertwo',
		'page',
		'side',
		'core'
	);
}
add_action( 'add_meta_boxes', 'powered_by_add_meta_footertwo' );

/**
 * Create a custom meta box for the footertwo Page taxonomy
 */
function powered_by_create_meta_box_footertwo( $post ) {
	
	// Use nonce for verification
  	wp_nonce_field( 'powered_by_footertwo_page', 'powered_by_footertwo_page_nonce' );

	// Retrieve the metadata values if the exist
	$use_as_footertwo = get_post_meta( $post->ID, '_use_as_footertwo', true );
	
	?>
		<label for="use_as_footertwo">
			<input type="checkbox" name="use_as_footertwo" id="use_as_footertwo" <?php checked( 'on', $use_as_footertwo ); ?> />
			<?php printf( __( 'Feature on the %1$s front page', 'powered-by' ), '<em>' . get_bloginfo( 'title' ) . '</em>' ); ?>
		</label>
	<?php
}

/**
 * Save the footertwo Page meta box data
 */
function powered_by_save_meta_box_data_footertwo( $post_id ) {

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( ! wp_verify_nonce( $_POST['powered_by_footertwo_page_nonce'], 'powered_by_footertwo_page' ) )
		return $post_id;

	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return $post_id;
		
	// Check permissions
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) )
			return $post_id;
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}

	// OK, we're authenticated: we need to find and save the data

	// Update use_as_footertwo value, default is off
	$use_as_footertwo = isset( $_POST['use_as_footertwo'] ) ? $_POST['use_as_footertwo'] : 'off';
	update_post_meta( $post_id, '_use_as_footertwo', $use_as_footertwo ); // Save the data

	if ( 'on' == $use_as_footertwo ) {
		// Add the footertwo term to this post
		wp_set_object_terms( $post_id, 'footertwo', 'footertwo' );
	} elseif ( 'off' == $use_as_footertwo ) {
		// Let's not use that term then
		wp_delete_object_term_relationships( $post_id, 'footertwo' );
	}
		
}
add_action( 'save_post', 'powered_by_save_meta_box_data_footertwo' );



// Just before the header div
function dgtheme_belowmenu() {
    do_action('dgtheme_belowmenu');
} // end thematic_aboveheader


function slideshow() {
global $post;


?><div id="slide-container"><div id="art-slideshow"> <?php
$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID ); 
			$attachments = get_posts($args);
			$loopcount = 1;
			if ($attachments) {
				foreach ( $attachments as $attachment ) {
				// echo apply_filters( 'the_title' , $attachment->post_title );
				$imageloader =  wp_get_attachment_image_src($attachment->ID,'article-header');
				?>
				 <img class="slide-image <?php if ($loopcount == 1) { echo 'active';} ?>" src="<?php echo $imageloader[0]; ?>" width="948" height="306" alt="<?php echo $template_name ?>"/>
				<?php 
				
				$loopcount = $loopcount + 1;
				}
			}


?></div></div><?php
//end action:
}
//now we can add our new action to the appropriate place like so:

add_action('dgtheme_belowmenu', 'slideshow' ,0);
/**
 * Register a custom taxonomy footer 1 & 2
 */


/*

Custom Post type for home page items.

*/

/**
 * This theme was built with PHP, Semantic HTML, CSS, love, and a Toolbox.
 */