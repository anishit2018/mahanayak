<?php
/*
* Template Name: Profile
*/
/*
 * if user allready logged in then
 * redirect this user to profile page.
 */
logged_in_user_checking(TRUE,site_url());
if($_REQUEST["action"]=='remove')
{
    $encrypted_id = $_GET["postId"];
    $decrypted_id_raw = base64_decode($encrypted_id);    
    $decrypted_id = intval(str_replace('MY_SECRET_STUFF', '', $decrypted_id_raw));
    //wp_trash_post( $decrypted_id  );
    wp_redirect(site_url()."/profile?action=removedone");
    //echo $decrypted_id; exit();
}
get_header(); ?>

<section class="section-content pv12 bg-cover" data-bg-image="images/coming-bg.jpg">
    <div class="container">
                 <div class="col-sm-12 page-title mt5 mb5">
                <h1 class="blog-title">Wellcome Abhay Nag</h1>
            </div>
        <div class="row"> 
            <div class="col-sm-8 col-xs-12 pl0">
                <div class="blog-container">
                    <article class="blog-item">
                        <div class="col-sm-4 col-xs-12 ">
                            <img class="post-image" src="<?php echo get_template_directory_uri(); ?>/images/jogen.jpg">
                        </div>
                        <div class="col-sm-8 col-xs-12 ml-r-15">
                            <div class="post-content">
                                <h2 class="user-tit"><?php echo $current_user->user_firstname.' '.$current_user->user_lastname; ?></h2>
                                <p class="entry-excepts"><?php echo $current_user->user_description; ?></p>
                            </div>
                        </div>
                    </article>
                    
                    <?php 
                    if($_REQUEST["action"]=='removedone')
                    {
                        echo "<div class='successdiv'>Event has been successfully removed.</div>";
                    }
                    ?>
                    <hr>

                        <div class="mh-tab mt2">
                            <div class="tabs-pro">
                                <a href="<?php echo site_url()."/gallery-edit"; ?>" class="tabs-pro-link col-md-3 col-xs-12">IMAGES</a>
                                <a href="<?php echo site_url()."/song-edit"; ?>" class="tabs-pro-link col-md-3 col-xs-12">MUSIC</a>
                                <a href="<?php echo site_url()."/fans-club-edit"; ?>" class="tabs-pro-link col-md-3 col-xs-12">FANS CLUB</a>
                                <a href="<?php echo site_url()."/profile"; ?>" class="tabs-pro-link col-md-3 col-xs-12 active">EVENTS</a>
                            </div>
                            <div class="tab-wraps">
                                <div class="tabcontents">
                                    <a href="#rat-popup" class="btn-vew"><i class="fa fa-plus"></i>Add Event</a>                                 
									<div id="rat-popup" class="rat-overlay over-scr">
                                      <?php echo do_shortcode( '[cr_event_form]' ); ?>
                                    </div>
                                    <div class="tab_body">
                                      <div class="row">
                                        <div class="col-xs-12 pl0">
                                            <div class="blog-container">
                                                
                                                <!-- start event listing --> 
                                                
                                                <?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;  
			$args = array(
			'post_type' => 'event',
			'post_status' =>  array( 'publish', 'draft'),
			'posts_per_page' => 3,
			'author' => $current_user->ID,
  			'paged'=> $paged	
			);
			$query = new WP_Query( $args );
			/*echo "<pre>";
			print_r($query);
			echo "</pre>";*/
			if(!empty($query->posts))
			{	  
			    foreach($query->posts as $event)
			{
			    $author_id=$event->post_author;
			    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $event->ID ), 'thumbnail' );
			    $startDate = get_post_meta( $event->ID, 'event_start_date', true );
			    $endDate = get_post_meta( $event->ID, 'event_end_date', true );
			    $startTime = get_post_meta( $event->ID, 'event_start_time', true );
			    $endTime = get_post_meta( $event->ID, 'event_end_time', true );
			    $hosted_by = get_post_meta( $event->ID, 'hosted_by', true );
			    $contact_number = get_post_meta( $event->ID, 'contact_number', true );
			    $contact_email = get_post_meta( $event->ID, 'contact_email', true );

			?>

    <article class="blog-item pty">
        <div class="row">
            <div class="col-sm-4 col-xs-12 ">
                <?php if(empty($image[0])) {?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/poster/poster-4.jpg" alt="">
                    <?php } else { ?>
                        <img src="<?php echo $image[0]; ?>" alt="<?php echo $event->post_title; ?>">
                        <?php } ?>
            </div>
            <div class="col-sm-8 ml-r-15">
                <div class="post-content pvt0">
                    <h2 class="host-title">Event's Name : <?php echo $event->post_title; ?></h2>
                    <p class="host-name">Hosted By:
                        <?php echo $hosted_by; ?>
                    </p>
                    <div class="time-icon">
                        <div class="row">
                            <div class="col-sm-6">
                                <div>Start from Date</div>
                                <div class="time-box fl">
                                    <?php echo date('d / m / Y',strtotime($startDate)); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div>End Date</div>
                                <div class="time-box fl">
                                    <?php echo date('d / m / Y',strtotime($endDate)); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mt2">
                            <div class="col-sm-6">
                                <div>Start Time</div>
                                <div class="time-box fl">
                                    <?php echo $startTime; ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div>End Time</div>
                                <div class="time-box fl">
                                    <?php echo $endTime; ?>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="time-icon mt1">
                        <div class="venue">Venue</div>
                        <span class="wt-80 fl"><?php echo $event->post_content; ?></span>
                        <div style="clear:both;"></div>
                        <?php 
                                   $salt="MY_SECRET_STUFF";
                                   $encrypted_id = base64_encode($event->ID . $salt);
                                   ?>
                            <span class="poststarus"><b><?php echo $event->post_status; ?></b></span><a href="<?php echo site_url()."/edit?action=remove&postId=".$encrypted_id; ?>" class="btn-vew">Edit</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo site_url()."/profile?action=remove&postId=".$encrypted_id; ?>" class="btn-vew" onclick="return confirm('Are you sure to remove <?php echo $event->post_title; ?> ?')">Remove</a>
                    </div>
                    <div class="time-icon mt3">
                        <span class="fl"><i class="fa fa-phone"></i></span>
                        <span class="fl">Contact No: <a href="tel:<?php echo $contact_number; ?>"><?php echo $contact_number; ?></a></span>
                    </div>
                    <div class="time-icon mt1">
                        <span class="fl"><i class="fa fa-envelope-o"></i></span>
                        <span class="fl">E-mail: <a href="mauilto:<?php echo $contact_email; ?>"><?php echo $contact_email; ?></a></span>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <?php }}else { echo "<article>No result found.</article>"; } ?>

                                            </div>
                                            
                                            <?php if(!empty($query->posts)) { ?>
            <div class="post-navigation mv3">
                <ul>
                    <li>
                        <?php previous_posts_link( '&laquo; PREV', $query->max_num_pages) ?>
                    </li>
                    <li>
                        <?php next_posts_link( 'NEXT &raquo;', $query->max_num_pages) ?>
                    </li>
                </ul>
            </div>
            <?php } ?> 
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        <div class="col-sm-4">
            <?php get_sidebar(); ?>
        </div>
</div> 
</section>


<?php get_footer();
?>
<script>
$(document).ready(function () {

	$( "#tabs" ).tabs();

    $('#frmevent').validate({ // initialize the plugin        
        rules: {
        	event_name: {
                required: true,
                //email: true
            },
            hosted_by: {
                required: true,
                //minlength: 5
            },
            start_from_date: {
                required: true,
                //minlength: 5
            },
            end_from_date: {
                required: true,
                //minlength: 5
            },
            start_time: {
                required: true,
                //minlength: 5
            },
            end_time: {
                required: true,
                //minlength: 5
            },
            venue: {
                required: true,
                //minlength: 5
            },
            contact_name: {
                required: true,
                //minlength: 5
            }, 
            contact_number: {
                required: true,
                //minlength: 5
            },
            contact_email: {
                required: true,
                //minlength: 5
            },
            event_file: {
                required: true,
                extension: "jpg|jpeg|png"
            },
        },
        submitHandler: function (form) { 
            //alert('valid form submitted'); 
            return true; // for demo
        }
    });

    $('#frmfans').validate({ // initialize the plugin        
        rules: {
        	fans_title: {
                required: true,
                //email: true
            },
            fans_content: {
                required: true,
                //email: true
            },  
            fans_file: {
                required: true,
                //email: true
            },          
        },
        submitHandler: function (form) { 
            //alert('valid form submitted'); 
            return true; // for demo
        }
    });

    $('#frmgallery').validate({ // initialize the plugin        
        rules: {
        	image_title: {
                required: true,
                //email: true
            },             
            image_file: {
                required: true,
                //email: true
            },          
        },
        submitHandler: function (form) { 
            //alert('valid form submitted'); 
            return true; // for demo
        }
    });

    $('#frmsong').validate({ // initialize the plugin        
        rules: {
        	music_title: {
                required: true,
                //email: true
            },             
            movie_name: {
                required: true,
                //email: true
            },          
        },
        submitHandler: function (form) { 
            //alert('valid form submitted'); 
            return true; // for demo
        }
    });

    

    $(".close").click(function(){
    	//location.reload();
    });

    
    function delConfirm() {
        var txt;
        if (confirm("Press a button!")) {
            return true;
        } else {
        	return false;
        }        
    }
    

});  
</script>
