<?php
/*
* Template Name: Profile edit
*/
/*
 * if user allready logged in then
 * redirect this user to profile page.
 */
logged_in_user_checking(TRUE,site_url());
if(isset($_POST["submit_registration"]))
{
    
  
    
    /*$allerror = "";
    $allsuccess = "";
    $allowed =  array('jpeg','png' ,'jpg');
    $filename = $_FILES['user_profile_image']['name'];   
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(!in_array($ext,$allowed) && !empty($filename)) {
        $allerror = "Not a valid file";
    }
    else if(in_array($ext,$allowed) && !empty($filename))
    {
        // These files need to be included as dependencies when on the front end.
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );
      
        $uploadedfile = $_FILES['user_profile_image'];        
        $upload_overrides = array( 'test_form' => false );        
        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
      
        if ( $movefile && ! isset( $movefile['error'] ) ) {
            
            //$file_name_and_location = $movefile ["file"];
            
            $profilepicture = $_FILES['user_profile_image'];
            $new_file_path = $wordpress_upload_dir['path'] . '/' . $profilepicture['name'];
            $new_file_mime = mime_content_type( $profilepicture['tmp_name'] );
            
            $upload_id = wp_insert_attachment( array(
                'guid'           => $movefile['file'],
                'post_mime_type' => $new_file_mime,
                'post_title'     => preg_replace( '/\.[^.]+$/', '', $profilepicture['name'] ),
                'post_content'   => '',
                'post_status'    => 'inherit'
            ), $movefile['file'] );
            
            // Generate and save the attachment metas into the database
            wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $movefile['file'] ) );
            
            /wp-admin/post.php?post=176&action=edit&image-editor
            update_user_meta( $current_user->ID, 'cupp_meta', '' );
            update_user_meta( $current_user->ID, 'cupp_upload_meta', $movefile['url'] );
            update_user_meta( $current_user->ID, 'cupp_upload_edit_meta', '/wp-admin/post.php?post='.$upload_id.'&action=edit&image-editor' );
        } 
        
    }    
    wp_update_user( array( 'ID' => $current_user->ID, 'first_name' => $_POST['fname'], 'last_name' => $_POST['lname'], 'description' => $_POST['about_user'] ) );
    
    $allsuccess = "Data has been successfully updated.";*/
    
    $wordpress_upload_dir = wp_upload_dir();
    // $wordpress_upload_dir['path'] is the full server path to wp-content/uploads/2017/05, for multisite works good as well
    // $wordpress_upload_dir['url'] the absolute URL to the same folder, actually we do not need it, just to show the link to file
    $i = 1; // number of tries when the file with the same name is already exists
    
    $profilepicture = $_FILES['profilepicture'];
    $new_file_path = $wordpress_upload_dir['path'] . '/' . $profilepicture['name'];
    $new_file_mime = mime_content_type( $profilepicture['tmp_name'] );
    
    if( empty( $profilepicture ) )
        die( 'File is not selected.' );
        
        if( $profilepicture['error'] )
            die( $profilepicture['error'] );
            
            if( $profilepicture['size'] > wp_max_upload_size() )
                die( 'It is too large than expected.' );
                
                if( !in_array( $new_file_mime, get_allowed_mime_types() ) )
                    die( 'WordPress doesn\'t allow this type of uploads.' );
                    
                    while( file_exists( $new_file_path ) ) {
                        $i++;
                        $new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $profilepicture['name'];
                    }
                    
                    // looks like everything is OK
                    if( move_uploaded_file( $profilepicture['tmp_name'], $new_file_path ) ) {
                        
                        
                        $upload_id = wp_insert_attachment( array(
                            'guid'           => $new_file_path,
                            'post_mime_type' => $new_file_mime,
                            'post_title'     => preg_replace( '/\.[^.]+$/', '', $profilepicture['name'] ),
                            'post_content'   => '',
                            'post_status'    => 'inherit'
                        ), $new_file_path );
                        
                        // wp_generate_attachment_metadata() won't work if you do not include this file
                        require_once( ABSPATH . 'wp-admin/includes/image.php' );
                        
                        // Generate and save the attachment metas into the database
                        wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );
                        
                        $postDetails = get_post($upload_id);
                       
                        $getDetailspath = wp_get_attachment_image_src($upload_id,'full');
                       
                        update_user_meta( $current_user->ID, 'cupp_meta', '' );
                        update_user_meta( $current_user->ID, 'cupp_upload_meta', $getDetailspath[0] );
                        update_user_meta( $current_user->ID, 'cupp_upload_edit_meta', '/wp-admin/post.php?post='.$upload_id.'&action=edit&image-editor' );
                        
                         
                        
                        // Show the uploaded file in browser
                        //wp_redirect( $wordpress_upload_dir['url'] . '/' . basename( $new_file_path ) );
                        
                    }
                    
                    wp_update_user( array( 'ID' => $current_user->ID, 'first_name' => $_POST['fname'], 'last_name' => $_POST['lname'], 'description' => $_POST['about_user'] ) );
                    unset($_POST);
                    $allsuccess = "Data has been successfully updated.";
    
}
get_header(); ?>
<section class="section-content pv12" data-bg-image="<?php echo get_template_directory_uri(); ?>/images/coming-bg.jpg">
    <div class="container">
        <div class="row">
            
        </div>        
    </div> 
    <div class="container">
         <div class="col-sm-12 page-title mt5 mb5">
                <h1 class="blog-title">Register</h1>
            </div>
        <div class="row"> 
            <div class="ma-login">
            <div class="row login-content">
                <div class="col-sm-7 col-xs-12">
                    <div class="entry-order-content">
                     <div class="errmsg"><?php echo $allerror; ?></div>
                     <div class="successmsg"><?php echo $allsuccess; ?></div>
                        <form id="msform" name="msform" method="post" action="" enctype="multipart/form-data">
                                <div class="wpc-content log-sub-text">
                                    <input  placeholder="First Name" class="txt-box" type="text" name="fname" id="fname" value="<?php echo $current_user->user_firstname; ?>">
                                    <input  placeholder="Last Name" class="txt-box" type="text" name="lname" id="lname" value="<?php echo $current_user->user_lastname; ?>">
                                    <input name="email_id" placeholder="Email Id" class="txt-box" type="text" value="<?php echo $current_user->user_email; ?>" readonly>
                                    <input name="user_name" placeholder="User Name" class="txt-box" type="text" value="<?php echo $current_user->user_login; ?>" readonly>                                    
                                    <textarea rows="3" cols="20" placeholder="About yourself...." class="input-box rs-size" name="about_user" id="about_user"><?php echo $current_user->user_description; ?></textarea>
                                    <input type="file" name="profilepicture" id="profilepicture"/>  
                                    <?php echo get_avatar( $current_user->ID, 32 );  ?>                                 
                                </div>
                                <div class="cl"></div>
                                <input name="submit_registration" class="next123 action-button" value="UPDATE" type="submit">
                        </form>
                    </div>
                </div>
                <div class="col-sm-5 col-xs-12 log-rh-cont">
                    <?php /*<h2>Sign In with your curent Facebook Account below.</h2>
                    <div class="order-details">
                      <div class="fb-box">
                        <a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/fb_logo.png" alt=""></a> 
                      </div>
                      <div class="logo-box">
                        <a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt=""></a> 
                      </div> 
                    </div>*/ ?>
                </div>
            </div>
        </div>
    </div> 
</section>
<script>
$(document).ready(function () {

    $('#msform').validate({ // initialize the plugin        
    	// Specify validation rules
        rules: {
          // The key name on the left side is the name attribute
          // of an input field. Validation rules are defined
          // on the right side
          fname: "required",
          lname: "required",
         
        },
        // Specify validation error messages
        messages: {
          firstname: "Please enter your firstname",
          lastname: "Please enter your lastname",          
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form) {
          form.submit();
        }
    });

});  
</script>
<?php get_footer();
?>
