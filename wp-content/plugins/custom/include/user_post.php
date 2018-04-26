<?php
/*
 * event add form
 *
 */

function add_event_form($args='')
{
    
    if(intval($args['postid'])>0)
    {
        $postDetails = get_post(intval($args['postid']));
        $author_id=$postDetails->post_author;
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $postDetails->ID ), 'thumbnail' );
        $startDate = get_post_meta( $postDetails->ID, 'event_start_date', true );
        $endDate = get_post_meta( $postDetails->ID, 'event_end_date', true );
        $startTime = get_post_meta( $postDetails->ID, 'event_start_time', true );
        $endTime = get_post_meta( $postDetails->ID, 'event_end_time', true );
        $hosted_by = get_post_meta( $postDetails->ID, 'hosted_by', true );
        $contact_number = get_post_meta( $postDetails->ID, 'contact_number', true );
        $contact_email = get_post_meta( $postDetails->ID, 'contact_email', true );
        $salt="MY_SECRET_STUFF";
        $encrypted_id = base64_encode($postDetails->ID . $salt);
    }
   
    if(isset($_POST["event_form_submit"]))
    {
        $allerror = "";
        $allsuccess = "";
        $allowed =  array('jpeg','png' ,'jpg');
        $filename = $_FILES['event_file']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!in_array($ext,$allowed) && empty($_POST["post_id"]) ) {
            $allerror = "Not a valid file";
        }
        
        if(empty($allerror))
        {
            // Create event post object
            $my_post = array(
                'post_title'    => wp_strip_all_tags( $_POST['event_name'] ),
                'post_content'  => $_POST['venue'],
                'post_status'   => 'draft',
                'post_type' => 'event',
                'post_author'   => $current_user->ID,                
            );
            
            
                if(empty($_POST["post_id"]))
                    $neweventId = wp_insert_post( $my_post ); // Insert the post into the database
                else
                {
                  
                    $encrypted_id = $_POST["post_id"];
                    $decrypted_id_raw = base64_decode($encrypted_id);
                    $neweventId = intval(str_replace('MY_SECRET_STUFF', '', $decrypted_id_raw));                 
                    $my_post['ID']=$neweventId;                  
                    wp_update_post($my_post);
                }
                update_post_meta($neweventId, 'event_start_date', $_POST["start_from_date"]);
                update_post_meta($neweventId, 'event_end_date', $_POST["end_from_date"]);
                update_post_meta($neweventId, 'event_start_time', $_POST["start_time"]);
                update_post_meta($neweventId, 'event_end_time', $_POST["end_time"]);
                update_post_meta($neweventId, 'event_venue', $_POST["venue"]);
                update_post_meta($neweventId, 'hosted_by', $_POST["hosted_by"]);
                update_post_meta($neweventId, 'contact_number', $_POST["contact_number"]);
                update_post_meta($neweventId, 'contact_email', $_POST["contact_email"]);
                
                // These files need to be included as dependencies when on the front end.
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                
                // Let WordPress handle the upload.               
                if(in_array($ext,$allowed)){
                    $attachment_id = media_handle_upload( 'event_file', $neweventId );
                    set_post_thumbnail( $neweventId, $attachment_id );
                }
                
                if(intval($args['postid'])>0){
                    $allsuccess = "The event successfully edited and waiting for admin approval.";
                }
                else
                    $allsuccess = "The event successfully added and waiting for admin approval.";
                    unset($_POST);
        }
        
    }
    
    ?>

<div class="form-pop">
 <form name="frmevent" id="frmevent" method="post" action="" enctype="multipart/form-data"> 
 <?php 
 if(intval($postDetails->ID)>0){
   $salt="MY_SECRET_STUFF";
   $encrypted_id = base64_encode($postDetails->ID . $salt);
   $pageHeading = "Edit Event";
   echo '<a href="'.site_url().'/profile">Back to event listing</a>';
 }
 else 
 {
   $pageHeading = "Add Event";
   echo '<a class="close" href="#">&times;</a>';
 }
 ?>  
 <div class="rat-pop-hed">
    <h3 class="pop-hed-text"><?php echo $pageHeading; ?></h3>
  </div>  
 <input type="hidden" name="post_id" id="post_id" value="<?php echo $encrypted_id; ?>">                               
 <div class="mh-log-form">
    <div class="errmsg"><?php echo $allerror; ?></div>
    <div class="successmsg"><?php echo $allsuccess; ?></div>
    <div class="box-row">
        <div class="sub-text">Event Name</div>
        <input type="text" class="input-box" name="event_name" id="event_name" value="<?php echo $postDetails->ID != '' ? $postDetails->post_title : $_POST["event_name"]; ?>">
    </div>
    
    <div class="box-row">
        <div class="sub-text">Hosted By</div>
        <input type="text" class="input-box" name="hosted_by" id="hosted_by" value="<?php echo $postDetails->ID != '' ? $hosted_by : $_POST["hosted_by"]; ?>">
        <!--<textarea rows="1" cols="20" placeholder="HOSTED BY" class="input-box rs-size"></textarea>-->
    </div>
    
    <div class="box-row">
      <div class="row">
          <div class="col-sm-6">
            <div class="sub-text">Start From Date</div>
            <div class="time-box fl">
              <input type="text" class="time-bg" id="datepicker1" name="start_from_date" value="<?php echo $postDetails->ID != '' ? $startDate : $_POST["start_from_date"]; ?>">
              <span class="fr"><i class="fa fa-calendar"></i></span>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="sub-text">End Date</div>
            <div class="time-box fl">
              <input type="text" class="time-bg" id="datepicker2" name="end_from_date" value="<?php echo $postDetails->ID != '' ? $endDate : $_POST["end_from_date"]; ?>">
              <span class="fr"><i class="fa fa-calendar"></i></span>
            </div>
          </div>
      </div>
    </div>

    <div class="box-row">
      <div class="row">
          <div class="col-sm-6">
            <div class="sub-text">Start Time</div>
            <div class="time-box pv4 fl">
              <div class="input-group mb0 time">
                  <input type="text" class="form-control dropdown-menu time-bg" id="timepicker" name="start_time" value="<?php echo $postDetails->ID != '' ? $startTime : $_POST["start_time"]; ?>">
                  <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="sub-text">End Time</div>
            <div class="time-box pv4 fl">
              <div class="input-group mb0 time">
                  <input type="text" class="form-control dropdown-menu time-bg" id="timepicker2" name="end_time" value="<?php echo $postDetails->ID != '' ? $endDate : $_POST["end_time"]; ?>">
                  <span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
              </div>
            </div>
          </div>
      </div>
    </div>
      
      <div class="box-row">
        <div class="sub-text">Venue</div>
        <input type="text" class="input-box" name="venue" value="<?php echo $postDetails->ID != '' ? $postDetails->post_content : $_POST["venue"]; ?>">
      </div>     
      
      <div class="box-row">
        <div class="sub-text">Contact Number</div>
        <input type="text" class="input-box" name="contact_number" value="<?php echo $postDetails->ID != '' ? $contact_number : $_POST["contact_number"]; ?>">
      </div>
      
      <div class="box-row">
        <div class="sub-text">Contact Email</div>
        <input type="text" class="input-box" name="contact_email" value="<?php echo $postDetails->ID != '' ? $contact_email : $_POST["contact_email"]; ?>">
      </div>

      <div class="box-row">
      <div>
        <div class="box-row-text fl">UPLOAD FILE</div>
        <?php
        if(intval($postDetails->ID>0))
            echo "<div><img src='".$image[0]."' alt='".$postDetails->post_title."' title='".$postDetails->post_title."'></div>";
        ?>
        <div class="box-row-rt fl">
            <input type="file" name="event_file" id="file-7" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" multiple />
            
            <label for="file-7"><span></span> 
              <strong> <i class="fa fa-folder-open" aria-hidden="true"></i> Choose a file…</strong>
            </label>

            <p class="exten-text fl">Only jpg, jpeg, png file is allowed.</p>
            <!-- <button class="up-btn fl">Add Event</button>-->
            <input type="submit" name="event_form_submit" id="event_form_submit" class="up-btn fl" value="Post Event">                                                    
        </div>
      </div>
    </div>
    
 </div>
 <div class="clearfix"></div> 
</from> 
</div>
<?php }

// Register a new shortcode: event
add_shortcode( 'cr_event_form', 'add_event_form' );


function add_fans_form($args='')
{
  
    if(intval($args['postid'])>0)
    {
        $postDetails = get_post(intval($args['postid']));
        $author_id=$postDetails->post_author;
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $postDetails->ID ), 'thumbnail' );        
        $salt="MY_SECRET_STUFF";
        $encrypted_id = base64_encode($event->ID . $salt);
    }
    
    if(isset($_POST["fans_form_submit"]))
    {       
        $allerror = "";
        $allsuccess = "";
        $allowed =  array('jpeg','png' ,'jpg');
        $filename = $_FILES['fans_file']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!in_array($ext,$allowed) && empty($_POST["post_id"])) {
            $allerror = "Not a valid file";
        }
        
        if(empty($allerror))
        {
                // Create event post object
                $my_post = array(
                'post_title'    => wp_strip_all_tags( $_POST['fans_title'] ),
                'post_content'  => $_POST['fans_content'],
                'post_status'   => 'draft',
                'post_type' => 'fans-club',
                'post_author'   => $current_user->ID,            
                );
                
                if(empty($_POST["post_id"]))                    
                    $newpostId = wp_insert_post( $my_post );// Insert the post into the database
                else
                {                    
                    $encrypted_id = $_POST["post_id"];
                    $decrypted_id_raw = base64_decode($encrypted_id);
                    $newpostId = intval(str_replace('MY_SECRET_STUFF', '', $decrypted_id_raw));                    
                    $my_post['ID']=$newpostId;                   
                    wp_update_post($my_post);
                }
            
            
            // These files need to be included as dependencies when on the front end.
            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            require_once( ABSPATH . 'wp-admin/includes/media.php' );
            
            // Let WordPress handle the upload.           
            if(in_array($ext,$allowed)){
            $attachment_id = media_handle_upload( 'fans_file', $newpostId );
            set_post_thumbnail( $newpostId, $attachment_id );
            }
            
            if(intval($args['postid'])>0)
                $allsuccess = "Fan's Club post successfully edited and waiting for admin approval.";
            else
                $allsuccess = "Fan's Club post successfully added and waiting for admin approval.";
            unset($_POST);
        }
        
    }
    
    ?>

<div class="form-pop">
 <form name="frmfans" id="frmfans" method="post" action="" enctype="multipart/form-data">
 <?php
 if(intval($args['postid'])>0){
   $salt="MY_SECRET_STUFF";
   $encrypted_id = base64_encode($postDetails->ID . $salt);
   $heading = "Edit Article";
   echo '<a href="'.site_url().'/fans-club-edit">Back to fan\'s club listing</a>';
 ?>  
 <input type="hidden" name="post_id" id="post_id" value="<?php echo $encrypted_id; ?>"> 
 <?php }else{
     $heading = "Post Article";
     echo '<a class="close" href="#">&times;</a>';
 } ?> 
 <div class="rat-pop-hed">
    <h3 class="pop-hed-text"><?php echo $heading; ?></h3>
  </div>                                         
 <div class="mh-log-form">
 	<div class="errmsg"><?php echo $allerror; ?></div>
    <div class="successmsg"><?php echo $allsuccess; ?></div>
  <div class="box-row">
      <div class="sub-text">Title</div>
      <input type="text" class="input-box" name="fans_title" id="fans_title" value="<?php echo $postDetails->ID != '' ? $postDetails->post_title : $_POST["fans_title"]; ?>">                                             
  </div>
  <div class="box-row">
     <textarea rows="3" cols="20" placeholder="Post Comment...." class="input-box rs-size" name="fans_content" id="fans_content"><?php echo $postDetails->ID != '' ? $postDetails->post_content : $_POST["fans_content"]; ?></textarea>
  </div>
    <div class="box-row">
      <div>
        <div class="box-row-text fl">UPLOAD FILE</div>
        <?php
        if(intval($postDetails->ID>0))
            echo "<div><img src='".$image[0]."' alt='".$postDetails->post_title."' title='".$postDetails->post_title."'></div>";
        ?>
        <div class="box-row-rt fl">
            <input type="file" name="fans_file" id="file-7" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" multiple />
            <label for="file-7"><span></span>
              <strong> <i class="fa fa-folder-open" aria-hidden="true"></i> Choose a file…</strong>
            </label>
            <p class="exten-text fl">Only jpg, jpeg, png file is allowed.</p>
            <input type="submit" name="fans_form_submit" id="fans_form_submit" class="up-btn fl" value="Post Articale">                                                    
        </div>
      </div>
    </div>
 </div>

 <div class="clearfix"></div> 
</from> 
</div>
<?php }

// Register a new shortcode: fans club
add_shortcode( 'cr_fans_form', 'add_fans_form' );

function add_gallery_form($args='')
{
    
    if(intval($args['postid'])>0)
    {
        $postDetails = get_post(intval($args['postid']));       
        $author_id=$postDetails->post_author;
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $postDetails->ID ), 'thumbnail' );
        $fullimage = wp_get_attachment_image_src( get_post_thumbnail_id( $postDetails->ID ), 'full' );
        $author_id=$gallery->post_author;
        $salt="MY_SECRET_STUFF";
        $encrypted_id = base64_encode($postDetails->ID . $salt);
    }
    
    if(isset($_POST["gallery_form_submit"]))
    {
      
        $allerror = "";
        $allsuccess = "";
        $allowed =  array('jpeg','png' ,'jpg');
        $filename = $_FILES['image_file']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
      
        if(empty($allerror))
        {
            
            // Create event post object
            $my_post = array(
            'post_title'    => wp_strip_all_tags( $_POST['image_title'] ),
            'post_content'  => $_POST['image_description'],
            'post_status'   => 'draft',
            'post_type' => 'gallery',
            'post_author'   => $current_user->ID,
            /*'post_category' => array( 8,39 )*/
            );
                
            if(empty($_POST["post_id"]))                
                $newpostId = wp_insert_post( $my_post ); //Insert the post into the database
            else
            {              
                $encrypted_id = $_POST["post_id"];
                $decrypted_id_raw = base64_decode($encrypted_id);
                $newpostId = intval(str_replace('MY_SECRET_STUFF', '', $decrypted_id_raw));  
                //add postid to $my_post array
                $my_post['ID']=$newpostId;                
                //Update the post into the database
                wp_update_post($my_post);
            }
            
            // These files need to be included as dependencies when on the front end.
            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            require_once( ABSPATH . 'wp-admin/includes/media.php' );
            
            // Let WordPress handle the upload.            
            if(in_array($ext,$allowed) ) {
            $attachment_id = media_handle_upload( 'image_file', $newpostId );
            set_post_thumbnail( $newpostId, $attachment_id );
            }
            
            if(intval($args['postid'])>0)
                $allsuccess = "Gallery successfully edited and waiting for admin approval.";
            else
                $allsuccess = "Gallery successfully added and waiting for admin approval.";
            unset($_POST);
        }
        
    }
    
    ?>

<div class="form-pop">
 <form name="frmgallery" id="frmgallery" method="post" action="" enctype="multipart/form-data">
 <?php 
 if(intval($postDetails->ID)>0)
 {
   $salt="MY_SECRET_STUFF";
   $encrypted_id = base64_encode($postDetails->ID . $salt);
   $heading = "Post Image";
   echo '<a href="'.site_url().'/gallery-edit">Back to image listing</a>';
 }
 else
 {
  $heading = "Edit Image";
  echo '<a class="close" href="#">&times;</a>';
}
 ?>  
 <input type="hidden" name="post_id" id="post_id" value="<?php echo $encrypted_id; ?>">  
  <div class="rat-pop-hed">
    <h3 class="pop-hed-text"><?php echo $heading; ?></h3>
  </div>
 <div class="mh-log-form">
     <div class="errmsg"><?php echo $allerror; ?></div>
     <div class="successmsg"><?php echo $allsuccess; ?></div>
  <div class="box-row">
      <div class="sub-text">Image Title</div>
      <input type="text" class="input-box" name="image_title" id="image_title" value="<?php echo $postDetails->ID != '' ? $postDetails->post_title : $_POST["image_title"]; ?>">                                             
  </div>  
  <div class="box-row">
     <textarea rows="3" cols="20" placeholder="Post Description...." class="input-box rs-size" name="image_description" id="image_description"><?php echo $postDetails->ID != '' ? $postDetails->post_content : $_POST["image_description"]; ?></textarea>
  </div>
    <div class="box-row">      
      <div class="box-row-text fl">UPLOAD FILE</div>
      	<?php
        if(intval($postDetails->ID>0))
            echo "<div><img src='".$image[0]."' alt='".$postDetails->post_title."' title='".$postDetails->post_title."'></div>";
        ?>	
         <div class="box-row-rt fl">
            <input type="file" name="image_file" id="file-7" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" multiple />
            <label for="file-7"><span></span>
              <strong> <i class="fa fa-folder-open" aria-hidden="true"></i> Choose a file…</strong>
            </label>
            <p class="exten-text fl">Only jpg, jpeg, png file is allowed.</p>
            <input type="submit" name="gallery_form_submit" id="gallery_form_submit" class="up-btn fl" value="Upload">                                                    
         </div>
      </div>
 </div>

 <div class="clearfix"></div> 
</from> 
</div>
<?php }
// Register a new shortcode: gallery image
add_shortcode( 'cr_gallery_form', 'add_gallery_form' );
function add_song_form($args='')
{
   
    if(intval($args['postid'])>0)
    {
        $postDetails = get_post(intval($args['postid']));      
        $author_id=$postDetails->post_author;
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $postDetails->ID ), array(50,50) );
        $strFile = get_post_meta($postDetails -> ID, $key = 'mp3_file', true);
        $movie_name = get_post_meta($postDetails -> ID, $key = 'movie_name', true);
        $salt="MY_SECRET_STUFF";
        $encrypted_id = base64_encode($postDetails->ID . $salt);
    }
    
    if(isset($_POST["song_form_submit"]))
    {       
        $allerror = "";
        $allsuccess = "";
        $allowed =  array('mp3');
        $filename = $_FILES['music_file']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!in_array($ext,$allowed) && empty($_POST["post_id"])) {
            $allerror = "Not a valid file";
        }
        
        if(empty($allerror))
        {
            // Create event post object
            $my_post = array(
            'post_title'    => wp_strip_all_tags( $_POST['music_title'] ),            
            'post_status'   => 'draft',
            'post_type' => 'song',
            'post_author'   => $current_user->ID,           
            );
             
            if(empty($_POST["post_id"]))            
                $newpostId = wp_insert_post( $my_post ); // Insert the post into the database
            else
            {
                $encrypted_id = $_POST["post_id"];
                $decrypted_id_raw = base64_decode($encrypted_id);
                $newpostId = intval(str_replace('MY_SECRET_STUFF', '', $decrypted_id_raw));  
                //add postid to the $my_post array
                $my_post['ID']=$newpostId;  
                // Update the post into the database
                wp_update_post($my_post);
            }
            
            update_post_meta($newpostId, 'movie_name', $_POST["movie_name"]);
            // These files need to be included as dependencies when on the front end.
            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            require_once( ABSPATH . 'wp-admin/includes/media.php' );
            
            // Let WordPress handle the upload.            
            if(in_array($ext,$allowed)){
            $attachment_id = media_handle_upload( 'music_file', $newpostId );
            update_post_meta($newpostId, 'mp3_file', wp_get_attachment_url( $attachment_id ));
            } 
            
            if(intval($args['postid'])>0)
              $allsuccess = "Song successfully edited and waiting for admin approval.";
            else
              $allsuccess = "Song successfully added and waiting for admin approval.";
            unset($_POST);
        }
        
    }
    
    ?>

<div class="form-pop">
 <form name="frmsong" id="frmsong" method="post" action="" enctype="multipart/form-data">
 <?php 
 if(intval($postDetails->ID)>0){
   $salt="MY_SECRET_STUFF";
   $encrypted_id = base64_encode($postDetails->ID . $salt);
   $heading = "Edit Music";
   echo '<a href="'.site_url().'/song-edit">Back to song listing</a>';
 }
 else 
 {
     $heading = "Add Music";
     echo '<a class="close" href="#">&times;</a>';
 }
 ?>  
 <input type="hidden" name="post_id" id="post_id" value="<?php echo $encrypted_id; ?>">  
  <div class="rat-pop-hed">
    <h3 class="pop-hed-text"><?php echo $heading; ?></h3>
  </div>
 <div class="mh-log-form">
 <div class="errmsg"><?php echo $allerror; ?></div>
     <div class="successmsg"><?php echo $allsuccess; ?></div>
  <div class="box-row">
      <div class="sub-text">Music Title</div>
      <input type="text" class="input-box" name="music_title" id="music_title" value="<?php echo $postDetails->ID != '' ? $postDetails->post_title : $_POST["music_title"]; ?>">                                             
  </div>
  <div class="box-row">
      <div class="sub-text">Movie Name</div>
      <input type="text" class="input-box" name="movie_name" id="movie_name" value="<?php echo $postDetails->ID != '' ? $movie_name : $_POST["movie_name"]; ?>">                                             
  </div>
    <div class="box-row">    
      <div class="box-row-text fl">UPLOAD FILE</div>
         <?php
            echo "<div><i>Current music file</i>: ".$strFile."</div>";
            echo do_shortcode('[sc_embed_player fileurl="'.$strFile.'"]');
         ?>
         <div class="box-row-rt fl">
            <input type="file" name="music_file" id="file-7" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" multiple />
            <label for="file-7"><span></span>
              <strong> <i class="fa fa-folder-open" aria-hidden="true"></i> Choose a file…</strong>
            </label>
            <p class="exten-text fl">Only mp3 file is allowed.</p>
            <input type="submit" name="song_form_submit" id="song_form_submit" class="up-btn fl" value="Upload">                                                    
         </div>
      </div>
 </div>
 
 <div class="clearfix"></div> 
</from> 
</div>
<?php }
// Register a new shortcode: fans club
add_shortcode( 'cr_song_form', 'add_song_form' );

?>