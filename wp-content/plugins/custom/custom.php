<?php
/*
Plugin Name: Custom
Plugin URI: http://d5ssoftware.com/
Description: This is a custom plugin for custom functionallity.
Author: D5S
Version: 1.0
*/
include 'include/user_post.php';
add_action( 'init', 'codex_device_init' );
/**
 * Register a book post type.
 * MOVIES 
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_device_init() {
    //movie 
    
	$labels = array(
		'name'               => _x( 'Movies', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Movie', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Movies', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Movie', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'movie', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Movie', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Movie', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Movie', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Movie', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Movies', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Movies', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Movies:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Movies found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Movies found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'movie' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'movie', $args );
	
	//song
	
	$labels = array(
	    'name'               => _x( 'Songs', 'post type general name', 'your-plugin-textdomain' ),
	    'singular_name'      => _x( 'Song', 'post type singular name', 'your-plugin-textdomain' ),
	    'menu_name'          => _x( 'Songs', 'admin menu', 'your-plugin-textdomain' ),
	    'name_admin_bar'     => _x( 'Song', 'add new on admin bar', 'your-plugin-textdomain' ),
	    'add_new'            => _x( 'Add New', 'movie', 'your-plugin-textdomain' ),
	    'add_new_item'       => __( 'Add New Song', 'your-plugin-textdomain' ),
	    'new_item'           => __( 'New Song', 'your-plugin-textdomain' ),
	    'edit_item'          => __( 'Edit Song', 'your-plugin-textdomain' ),
	    'view_item'          => __( 'View Song', 'your-plugin-textdomain' ),
	    'all_items'          => __( 'All Songs', 'your-plugin-textdomain' ),
	    'search_items'       => __( 'Search Songs', 'your-plugin-textdomain' ),
	    'parent_item_colon'  => __( 'Parent Songs:', 'your-plugin-textdomain' ),
	    'not_found'          => __( 'No Songs found.', 'your-plugin-textdomain' ),
	    'not_found_in_trash' => __( 'No Songs found in Trash.', 'your-plugin-textdomain' )
	);
	
	$args = array(
	    'labels'             => $labels,
	    'description'        => __( 'Description.', 'your-plugin-textdomain' ),
	    'public'             => true,
	    'publicly_queryable' => true,
	    'show_ui'            => true,
	    'show_in_menu'       => true,
	    'query_var'          => true,
	    'rewrite'            => array( 'slug' => 'song' ),
	    'capability_type'    => 'post',
	    'has_archive'        => true,
	    'hierarchical'       => false,
	    'menu_position'      => null,
	    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);
	
	register_post_type( 'song', $args );
	
	//Testimonials
	
	$labels = array(
	    'name'               => _x( 'Testimonials', 'post type general name', 'your-plugin-textdomain' ),
	    'singular_name'      => _x( 'Testimonial', 'post type singular name', 'your-plugin-textdomain' ),
	    'menu_name'          => _x( 'Testimonials', 'admin menu', 'your-plugin-textdomain' ),
	    'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'your-plugin-textdomain' ),
	    'add_new'            => _x( 'Add New', 'movie', 'your-plugin-textdomain' ),
	    'add_new_item'       => __( 'Add New Testimonial', 'your-plugin-textdomain' ),
	    'new_item'           => __( 'New Testimonial', 'your-plugin-textdomain' ),
	    'edit_item'          => __( 'Edit Testimonial', 'your-plugin-textdomain' ),
	    'view_item'          => __( 'View Testimonial', 'your-plugin-textdomain' ),
	    'all_items'          => __( 'All Testimonials', 'your-plugin-textdomain' ),
	    'search_items'       => __( 'Search Testimonials', 'your-plugin-textdomain' ),
	    'parent_item_colon'  => __( 'Parent Testimonials:', 'your-plugin-textdomain' ),
	    'not_found'          => __( 'No Testimonials found.', 'your-plugin-textdomain' ),
	    'not_found_in_trash' => __( 'No Testimonials found in Trash.', 'your-plugin-textdomain' )
	);
	
	$args = array(
	    'labels'             => $labels,
	    'description'        => __( 'Description.', 'your-plugin-textdomain' ),
	    'public'             => true,
	    'publicly_queryable' => true,
	    'show_ui'            => true,
	    'show_in_menu'       => true,
	    'query_var'          => true,
	    'rewrite'            => array( 'slug' => 'testimonial' ),
	    'capability_type'    => 'post',
	    'has_archive'        => true,
	    'hierarchical'       => false,
	    'menu_position'      => null,
	    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);
	
	register_post_type( 'testimonial', $args );
	
	//Events
	
	$labels = array(
	    'name'               => _x( 'Events', 'post type general name', 'your-plugin-textdomain' ),
	    'singular_name'      => _x( 'Event', 'post type singular name', 'your-plugin-textdomain' ),
	    'menu_name'          => _x( 'Events', 'admin menu', 'your-plugin-textdomain' ),
	    'name_admin_bar'     => _x( 'Event', 'add new on admin bar', 'your-plugin-textdomain' ),
	    'add_new'            => _x( 'Add New', 'movie', 'your-plugin-textdomain' ),
	    'add_new_item'       => __( 'Add New Event', 'your-plugin-textdomain' ),
	    'new_item'           => __( 'New Event', 'your-plugin-textdomain' ),
	    'edit_item'          => __( 'Edit Event', 'your-plugin-textdomain' ),
	    'view_item'          => __( 'View Event', 'your-plugin-textdomain' ),
	    'all_items'          => __( 'All Events', 'your-plugin-textdomain' ),
	    'search_items'       => __( 'Search Events', 'your-plugin-textdomain' ),
	    'parent_item_colon'  => __( 'Parent Events:', 'your-plugin-textdomain' ),
	    'not_found'          => __( 'No Events found.', 'your-plugin-textdomain' ),
	    'not_found_in_trash' => __( 'No Events found in Trash.', 'your-plugin-textdomain' )
	);
	
	$args = array(
	    'labels'             => $labels,
	    'description'        => __( 'Description.', 'your-plugin-textdomain' ),
	    'public'             => true,
	    'publicly_queryable' => true,
	    'show_ui'            => true,
	    'show_in_menu'       => true,
	    'query_var'          => true,
	    'rewrite'            => array( 'slug' => 'event' ),
	    'capability_type'    => 'post',
	    'has_archive'        => true,
	    'hierarchical'       => false,
	    'menu_position'      => null,
	    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);
	
	register_post_type( 'event', $args );
	
	//GALLERY	
	
	$labels = array(
	    'name'               => _x( 'Gallery', 'post type general name', 'your-plugin-textdomain' ),
	    'singular_name'      => _x( 'Gallery', 'post type singular name', 'your-plugin-textdomain' ),
	    'menu_name'          => _x( 'Gallery', 'admin menu', 'your-plugin-textdomain' ),
	    'name_admin_bar'     => _x( 'Gallery', 'add new on admin bar', 'your-plugin-textdomain' ),
	    'add_new'            => _x( 'Add New', 'movie', 'your-plugin-textdomain' ),
	    'add_new_item'       => __( 'Add New Gallery', 'your-plugin-textdomain' ),
	    'new_item'           => __( 'New Gallery', 'your-plugin-textdomain' ),
	    'edit_item'          => __( 'Edit Gallery', 'your-plugin-textdomain' ),
	    'view_item'          => __( 'View Gallery', 'your-plugin-textdomain' ),
	    'all_items'          => __( 'All Gallery', 'your-plugin-textdomain' ),
	    'search_items'       => __( 'Search Gallery', 'your-plugin-textdomain' ),
	    'parent_item_colon'  => __( 'Parent Gallery:', 'your-plugin-textdomain' ),
	    'not_found'          => __( 'No Gallery found.', 'your-plugin-textdomain' ),
	    'not_found_in_trash' => __( 'No Gallery found in Trash.', 'your-plugin-textdomain' )
	);
	
	$args = array(
	    'labels'             => $labels,
	    'description'        => __( 'Description.', 'your-plugin-textdomain' ),
	    'public'             => true,
	    'publicly_queryable' => true,
	    'show_ui'            => true,
	    'show_in_menu'       => true,
	    'query_var'          => true,
	    'rewrite'            => array( 'slug' => 'gallery' ),
	    'capability_type'    => 'post',
	    'has_archive'        => true,
	    'hierarchical'       => false,
	    'menu_position'      => null,
	    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);
	
	register_post_type( 'gallery', $args );
	
	//FAN'S CLUB
	
	
	$labels = array(
	    'name'               => _x( 'Fans Club', 'post type general name', 'your-plugin-textdomain' ),
	    'singular_name'      => _x( 'Fans Club', 'post type singular name', 'your-plugin-textdomain' ),
	    'menu_name'          => _x( 'Fans Club', 'admin menu', 'your-plugin-textdomain' ),
	    'name_admin_bar'     => _x( 'Fans Club', 'add new on admin bar', 'your-plugin-textdomain' ),
	    'add_new'            => _x( 'Add New', 'movie', 'your-plugin-textdomain' ),
	    'add_new_item'       => __( 'Add New Fans Club', 'your-plugin-textdomain' ),
	    'new_item'           => __( 'New Fans Club', 'your-plugin-textdomain' ),
	    'edit_item'          => __( 'Edit Fans Club', 'your-plugin-textdomain' ),
	    'view_item'          => __( 'View Fans Club', 'your-plugin-textdomain' ),
	    'all_items'          => __( 'All Fans Club', 'your-plugin-textdomain' ),
	    'search_items'       => __( 'Search Fans Club', 'your-plugin-textdomain' ),
	    'parent_item_colon'  => __( 'Parent Fans Club:', 'your-plugin-textdomain' ),
	    'not_found'          => __( 'No Fans Club found.', 'your-plugin-textdomain' ),
	    'not_found_in_trash' => __( 'No Fans Club found in Trash.', 'your-plugin-textdomain' )
	);
	
	$args = array(
	    'labels'             => $labels,
	    'description'        => __( 'Description.', 'your-plugin-textdomain' ),
	    'public'             => true,
	    'publicly_queryable' => true,
	    'show_ui'            => true,
	    'show_in_menu'       => true,
	    'query_var'          => true,
	    'rewrite'            => array( 'slug' => 'fans-club' ),
	    'capability_type'    => 'post',
	    'has_archive'        => true,
	    'hierarchical'       => false,
	    'menu_position'      => null,
	    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);
	
	register_post_type( 'fans-club', $args );
	
	if ( ! current_user_can( 'manage_options' ) ) {
	    show_admin_bar( false );
	}
}
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_taxonomies', 0 );

// create one taxonomies, Song category
function create_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    /*$labels = array(
        'name'              => _x( 'Song Categoies', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Song category', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Song Categoies', 'textdomain' ),
        'all_items'         => __( 'All Song Categoies', 'textdomain' ),
        'parent_item'       => __( 'Parent Song category', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Song category:', 'textdomain' ),
        'edit_item'         => __( 'Edit Song category', 'textdomain' ),
        'update_item'       => __( 'Update Song category', 'textdomain' ),
        'add_new_item'      => __( 'Add New Song category', 'textdomain' ),
        'new_item_name'     => __( 'New Song category Name', 'textdomain' ),
        'menu_name'         => __( 'Song category', 'textdomain' ),
    );
    
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'song-category' ),
    );    
    register_taxonomy( 'song-category', array( 'song' ), $args );*/   
    
    /*$labels = array(
        'name'              => _x( 'Fans Club Categoies', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Fans Club category', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Fans Club Categoies', 'textdomain' ),
        'all_items'         => __( 'All Fans Club Categoies', 'textdomain' ),
        'parent_item'       => __( 'Parent Fans Club category', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Fans Club category:', 'textdomain' ),
        'edit_item'         => __( 'Edit Fans Club category', 'textdomain' ),
        'update_item'       => __( 'Update Fans Club category', 'textdomain' ),
        'add_new_item'      => __( 'Add New Fans Club category', 'textdomain' ),
        'new_item_name'     => __( 'New Fans Club category Name', 'textdomain' ),
        'menu_name'         => __( 'Fans Club category', 'textdomain' ),
    );
    
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'fans-club-category' ),
    );
    register_taxonomy( 'fans-club-category', array( 'fans-club' ), $args );*/    
}

//Add Metabox for mp3 file with song post type
add_action('add_meta_boxes', 'add_upload_file_metaboxes');

function add_upload_file_metaboxes() {
    add_meta_box('mp3_file_upload', 'MP3 File Upload', 'mp3_file_upload', 'song', 'normal', 'default');
}

function mp3_file_upload() {
    global $post;
    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="mp3_noncename" id="mp3_noncename" value="'.
        wp_create_nonce(plugin_basename(__FILE__)).
        '" />';
        global $wpdb;
        $strFile = get_post_meta($post -> ID, $key = 'mp3_file', true);
        $media_file = get_post_meta($post -> ID, $key = '_wp_attached_file', true);
        if (!empty($media_file)) {
            $strFile = $media_file;
        } ?>


    <script type = "text/javascript">

        // Uploading files
        var file_frame;
    	jQuery('#upload_file_button').live('click', function(podcast) {

        podcast.preventDefault();

        // If the media frame already exists, reopen it.
        if (file_frame) {
            file_frame.open();
            return;
        }

        // Create the media frame.
        file_frame = wp.media.frames.file_frame = wp.media({
            title: jQuery(this).data('uploader_title'),
            button: {
                text: jQuery(this).data('uploader_button_text'),
            },
            multiple: false // Set to true to allow multiple files to be selected
        });

        // When a file is selected, run a callback.
        file_frame.on('select', function(){
            // We set multiple to false so only get one image from the uploader
            attachment = file_frame.state().get('selection').first().toJSON();
            var url = attachment.url;          
            var field = document.getElementById("mp3_file");
            field.value = url; //set which variable you want the field to have
        });

        // Finally, open the modal
        file_frame.open();
    });

    </script>



    <div>

        <table>
        <tr valign = "top">
        <td>
        <input type = "text" name = "mp3_file" id = "mp3_file" size = "70" value = "<?php echo $strFile; ?>"/>
        <input id = "upload_file_button" type = "button" value = "Upload">
        </td> 
        </tr> 
        </table> 
        <input type = "hidden" name = "file_txt_id" id = "file_txt_id" value = "" />
        </div>     <?php
    function admin_scripts() {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
    }

    function admin_styles() {
        wp_enqueue_style('thickbox');
    }
    add_action('admin_print_scripts', 'admin_scripts');
    add_action('admin_print_styles', 'admin_styles');
}


//Saving the file
function save_mp3_meta($post_id, $post) {
    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if (!wp_verify_nonce($_POST['mp3_noncename'], plugin_basename(__FILE__))) {
        return $post -> ID;
    }
    // Is the user allowed to edit the post?
    if (!current_user_can('edit_post', $post -> ID))
        return $post -> ID;
    // We need to find and save the data
    // We'll put it into an array to make it easier to loop though.
    $podcasts_meta['mp3_file'] = $_POST['mp3_file'];
    // Add values of $podcasts_meta as custom fields   
    

    foreach($podcasts_meta as $key => $value) {
        if ($post -> post_type == 'revision') return;
        $value = implode(',', (array) $value);
        if (get_post_meta($post -> ID, $key, FALSE)) { // If the custom field already has a value it will update
            update_post_meta($post -> ID, $key, $value);
        } else { // If the custom field doesn't have a value it will add
            add_post_meta($post -> ID, $key, $value);
        }
        if (!$value) delete_post_meta($post -> ID, $key); // Delete if blank value
    }
}
add_action('save_post', 'save_mp3_meta', 1, 2); // save the custom fields

//start song meta box
function wpdocs_song_meta_boxes() {
    add_meta_box( 'meta-box-id', __( 'Movie name', 'textdomain' ), 'wpdocs_my_song_callback', 'song' );
}
add_action( 'add_meta_boxes', 'wpdocs_song_meta_boxes' );

function wpdocs_my_song_callback( $post ) {
    global $post;
    // Nonce field to validate form request came from current site
    wp_nonce_field( basename( __FILE__ ), 'song_fields' );    
    $movie_name = get_post_meta($post -> ID, $key = 'movie_name', true);
    echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">';
    echo '<tr><td>Movie Name</td><td><input type="textbox" name="movie_name" id="movie_name" value="'.$movie_name.'" ></td></tr>';
    echo '</table>';
}
function wpdocs_save_song_meta_box( $post_id ) {
    // Save logic goes here. Don't forget to include nonce checks!
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }
    if ( ! wp_verify_nonce( $_POST['song_fields'], basename(__FILE__) ) ) {
        return $post_id;
    }   
    update_post_meta($post_id, 'movie_name', $_POST["movie_name"]);
}
add_action( 'save_post', 'wpdocs_save_song_meta_box' );
//end song meta box

//start event meta box
/**
 * Register meta box(es).
 */
function wpdocs_event_meta_boxes() {
    add_meta_box( 'meta-box-id', __( 'Event Details', 'textdomain' ), 'wpdocs_my_event_callback', 'event' );
}
add_action( 'add_meta_boxes', 'wpdocs_event_meta_boxes' );

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function wpdocs_my_event_callback( $post ) {
    global $post;
    // Nonce field to validate form request came from current site
    wp_nonce_field( basename( __FILE__ ), 'event_fields' );
    // Get the location data if it's already been entered
    $startDate = get_post_meta( $post->ID, 'event_start_date', true );
    $endDate = get_post_meta( $post->ID, 'event_end_date', true );
    $startTime = get_post_meta( $post->ID, 'event_start_time', true );
    $endTime = get_post_meta( $post->ID, 'event_end_time', true );
    $hosted_by = get_post_meta( $post->ID, 'hosted_by', true );
    $contact_number = get_post_meta( $post->ID, 'contact_number', true );
    $contact_email = get_post_meta( $post->ID, 'contact_email', true );
    
    echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">';
    echo '<tr><td>Start Date</td><td><input type="textbox" name="start_date" id="start_date" value="'.$startDate.'" readonly="readonly"></td></tr>';
    echo '<tr><td>End Date</td><td><input type="textbox" name="end_date" id="end_date" value="'.$endDate.'" readonly="readonly"></td></tr>';  
    echo '<tr><td>Start Time</td><td><input type="textbox" name="start_time" id="start_time" value="'.$startTime.'" ></td></tr>';
    echo '<tr><td>End Time</td><td><input type="textbox" name="end_time" id="end_time" value="'.$endTime.'" ></td></tr>';
    echo '<tr><td>Hosted By</td><td><input type="textbox" name="hosted_by" id="hosted_by" value="'.$hosted_by.'" ></td></tr>';
    echo '<tr><td>Contact Number</td><td><input type="textbox" name="contact_number" id="contact_number" value="'.$contact_number.'" ></td></tr>';
    echo '<tr><td>Contact Email</td><td><input type="textbox" name="contact_email" id="contact_email" value="'.$contact_email.'" ></td></tr>';
    echo '</table>';
    echo '<script>
            $( document ).ready(function() {
                $( function() {
                    $( "#start_date" ).datepicker();
                    $( "#end_date" ).datepicker();
                } );
            });
          </script>';
}
/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function wpdocs_save_event_meta_box( $post_id ) {
    // Save logic goes here. Don't forget to include nonce checks!
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }
    if ( ! wp_verify_nonce( $_POST['event_fields'], basename(__FILE__) ) ) {
        return $post_id;
    }
    
    /*echo "<pre>";
    print_r($_POST); echo "</pre>"; exit();*/
    update_post_meta($post_id, 'event_start_date', $_POST["start_date"]);
    update_post_meta($post_id, 'event_end_date', $_POST["end_date"]);
    update_post_meta($post_id, 'event_start_time', $_POST["start_time"]);
    update_post_meta($post_id, 'event_end_time', $_POST["end_time"]);
    update_post_meta($post_id, 'contact_number', $_POST["contact_number"]);
    update_post_meta($post_id, 'contact_email', $_POST["contact_email"]);
    update_post_meta($post_id, 'hosted_by', $_POST["hosted_by"]);
   
}
add_action( 'save_post', 'wpdocs_save_event_meta_box' );
//end event meta box

function your_namespace() {
    wp_register_style('your_namespace', plugins_url('css/jquery-ui.css',__FILE__ ));
    wp_enqueue_style('your_namespace');
    wp_register_script( 'your_namespace', plugins_url('js/jquery-ui.js',__FILE__ ));
    wp_enqueue_script('your_namespace');
    wp_register_script( 'your_namespace', plugins_url('js/custom.js',__FILE__ ));
    wp_enqueue_script('your_namespace');
}

add_action( 'admin_init','your_namespace');

/*
 * custom function for redirect user 
 * depend on their logged in status.
 * 19/04/2018
 * @anish
 */

function logged_in_user_checking($loggedinstatus=TRUE,$url="")
{
    if(is_user_logged_in()!=$loggedinstatus)
    {
        if(empty($url))
        $url = site_url();
        wp_redirect( $url );
        exit;
    }
}



/*
 * @author	Ryan Sutana
 * @desc	Process all datas coming from theme-ajax.js
 * since 	v 1.0
 */

add_action( 'wp_ajax_nopriv_lost_pass', 'lost_pass_callback' );
add_action( 'wp_ajax_lost_pass', 'lost_pass_callback' );
/*
 *	@desc	Process lost password
 */
function lost_pass_callback() {
    
    global $wpdb, $wp_hasher;
    
    $nonce = $_POST['nonce'];
    
    if ( ! wp_verify_nonce( $nonce, 'rs_user_lost_password_action' ) )
        die ( 'Security checked!');
        
        //We shall SQL escape all inputs to avoid sql injection.
        $user_login = $_POST['user_login'];
        
        $errors = new WP_Error();
        
        if ( empty( $user_login ) ) {
            $errors->add('empty_username', __('<strong>ERROR</strong>: Enter a username or e-mail address.'));
        } else if ( strpos( $user_login, '@' ) ) {
            $user_data = get_user_by( 'email', trim( $user_login ) );
            if ( empty( $user_data ) )
                $errors->add('invalid_email', __('<strong>ERROR</strong>: There is no user registered with that email address.'));
        } else {
            $login = trim( $user_login );
            $user_data = get_user_by('login', $login);
        }
        
        /**
         * Fires before errors are returned from a password reset request.
         *
         * @since 2.1.0
         * @since 4.4.0 Added the `$errors` parameter.
         *
         * @param WP_Error $errors A WP_Error object containing any errors generated
         *                         by using invalid credentials.
         */
        do_action( 'lostpassword_post', $errors );
        
        if ( $errors->get_error_code() )
            return $errors;
            
            if ( !$user_data ) {
                $errors->add('invalidcombo', __('<strong>ERROR</strong>: Invalid username or email.'));
                return $errors;
            }
            
            // Redefining user_login ensures we return the right case in the email.
            $user_login = $user_data->user_login;
            $user_email = $user_data->user_email;
            $key = get_password_reset_key( $user_data );
            
            if ( is_wp_error( $key ) ) {
                return $key;
            }
            
            $message = __('Someone requested that the password be reset for the following account:') . "\r\n\r\n";
            $message .= network_home_url( '/' ) . "\r\n\r\n";
            $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
            $message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
            $message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
            //$message .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . "\r\n";
            
            // replace PAGE_ID with reset page ID
            $message .= esc_url( get_permalink( PAGE_ID ) . "/?action=rp&key=$key&login=" . rawurlencode($user_login) ) . "\r\n";
            
            if ( is_multisite() )
                $blogname = $GLOBALS['current_site']->site_name;
                else
                    /*
                     * The blogname option is escaped with esc_html on the way into the database
                     * in sanitize_option we want to reverse this for the plain text arena of emails.
                     */
                         $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
                         
                         $title = sprintf( __('[%s] Password Reset'), $blogname );
                         
                         /**
                          * Filter the subject of the password reset email.
                          *
                          * @since 2.8.0
                          * @since 4.4.0 Added the `$user_login` and `$user_data` parameters.
                          *
                          * @param string  $title      Default email title.
                          * @param string  $user_login The username for the user.
                          * @param WP_User $user_data  WP_User object.
                          */
                         $title = apply_filters( 'retrieve_password_title', $title, $user_login, $user_data );
                         
                         /**
                          * Filter the message body of the password reset mail.
                          *
                          * @since 2.8.0
                          * @since 4.1.0 Added `$user_login` and `$user_data` parameters.
                          *
                          * @param string  $message    Default mail message.
                          * @param string  $key        The activation key.
                          * @param string  $user_login The username for the user.
                          * @param WP_User $user_data  WP_User object.
                          */
                         $message = apply_filters( 'retrieve_password_message', $message, $key, $user_login, $user_data );
                         
                         if ( wp_mail( $user_email, wp_specialchars_decode( $title ), $message ) )
                             $errors->add('confirm', __('Check your e-mail for the confirmation link.'), 'message');
                             else
                                 $errors->add('could_not_sent', __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function.'), 'message');
                                 
                                 
                                 // display error message
                                 if ( $errors->get_error_code() )
                                     echo '<p class="error">'.$errors->get_error_message( $errors->get_error_code() ).'</p>';
                                     
                                     // return proper result
                                     die();
}

add_action( 'wp_ajax_nopriv_reset_pass', 'reset_pass_callback' );
add_action( 'wp_ajax_reset_pass', 'reset_pass_callback' );


function post_ajax_comment() {
    
    global $current_user;
    get_currentuserinfo();
    
    
    // The $_REQUEST contains all the data sent via ajax
    if ( isset($_REQUEST) ) {        
        $user_msg = $_REQUEST['user_msg'];
        $time = current_time('mysql'); 
        
        if(empty($_REQUEST['user_msg']))
        {
            echo "<span='errmsg'>Please write your comment.</span>";
            exit;
        }
        if(!is_user_logged_in() && empty($_REQUEST['author_name']))
        {
            echo "<span='errmsg'>Please enter your name.</span>";
            exit;
        }
        if(!is_user_logged_in() && is_email($_REQUEST['author_email']))
        {
            echo "<span='errmsg'>Please enter your valid email.</span>";
            exit;
        }
        
       
        
        if(is_user_logged_in())
        {
            $data = array(
                'comment_post_ID' => $_REQUEST["galId"],
                'comment_author' => $current_user->user_login,
                'comment_author_email' => $current_user->user_email,            
                'comment_content' => $user_msg,
                'comment_type' => '',
                'comment_parent' => 0,
                'user_id' => $current_user->ID,            
                'comment_date' => $time,
                'comment_approved' => 0,
            );
        }
        else 
        {
            $data = array(
                'comment_post_ID' => $_REQUEST["galId"],
                'comment_author' => $_REQUEST['author_name'],
                'comment_author_email' => $_REQUEST['author_email'],
                'comment_content' => $user_msg,
                'comment_type' => '',
                'comment_parent' => 0,                
                'comment_date' => $time,
                'comment_approved' => 0,
            );
        }
        
        wp_insert_comment($data);
        //wp_insert_comment($data);        
        echo "Your comment posted successfully.";
        exit();
     
    }
    
    // Always die in functions echoing ajax content
    die();
}

add_action( 'wp_ajax_post_ajax_comment', 'post_ajax_comment' );
add_action( 'wp_ajax_nopriv_post_ajax_comment', 'post_ajax_comment' );

function custom_retrieve_password($user_login){
    global $wpdb, $wp_hasher;
    $user_login = sanitize_text_field($user_login);
    if ( empty( $user_login) ) {
        return false;
    } else if ( strpos( $user_login, '@' ) ) {
        $user_data = get_user_by( 'email', trim( $user_login ) );
        if ( empty( $user_data ) )
            return false;
    } else {
        $login = trim($user_login);
        $user_data = get_user_by('login', $login);
    }
    
    do_action('lostpassword_post');
    if ( !$user_data ) return false;
    // redefining user_login ensures we return the right case in the email
    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;
    do_action('retreive_password', $user_login);  // Misspelled and deprecated
    do_action('retrieve_password', $user_login);
    $allow = apply_filters('allow_password_reset', true, $user_data->ID);
    if ( ! $allow )
        return false;
        else if ( is_wp_error($allow) )
            return false;
            $key = wp_generate_password( 20, false );
            do_action( 'retrieve_password_key', $user_login, $key );
            
            if ( empty( $wp_hasher ) ) {
                require_once ABSPATH . 'wp-includes/class-phpass.php';
                $wp_hasher = new PasswordHash( 8, true );
            }
            $hashed = $wp_hasher->HashPassword( $key );
            $wpdb->update( $wpdb->users, array( 'user_activation_key' => time().":".$hashed ), array( 'user_login' => $user_login ) );
            $message = __('Someone requested that the password be reset for the following account:') . "\r\n\r\n";
            $message .= network_home_url( '/' ) . "\r\n\r\n";
            $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
            $message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
            $message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
            $message .= '<' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . ">\r\n";
            
            if ( is_multisite() )
                $blogname = $GLOBALS['current_site']->site_name;
                else
                    $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
                    
                    $title = sprintf( __('[%s] Password Reset'), $blogname );
                    
                    $title = apply_filters('retrieve_password_title', $title);
                    $message = apply_filters('retrieve_password_message', $message, $key);
                    
                    //if ( $message && !wp_mail($user_email, $title, $message) )
                        //wp_die( __('The e-mail could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function...') );
                        
                        return '<p>Link for password reset has been emailed to you. Please check your email.</p>';;
}


?>                                      
