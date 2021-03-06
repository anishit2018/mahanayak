<?php
/*
* Template Name: Songs edit
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
    wp_redirect(site_url()."/song-edit?action=removedone");
    //echo $decrypted_id; exit();
}
get_header(); ?>

<section class="section-content pv12 bg-cover" data-bg-image="images/coming-bg.jpg">
    <div class="container">
                 <div class="col-sm-12 page-title mt5 mb5">
                <h1 class="blog-title">Wellcome <?php echo $current_user->user_firstname.' '.$current_user->user_lastname; ?></h1>
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
                        echo "<div class='successdiv'>Song has been removed successfully.</div>";
                    }
                    ?>
                    
                    <hr>

                        <div class="mh-tab mt2" id="tabs">
                            <div class="tabs-pro">
                                <a href="<?php echo site_url()."/gallery-edit"; ?>" class="tabs-pro-link col-md-3 col-xs-12">IMAGES</a>
                                <a href="<?php echo site_url()."/song-edit"; ?>" class="tabs-pro-link col-md-3 col-xs-12 active">MUSIC</a>
                                <a href="<?php echo site_url()."/fans-club-edit"; ?>" class="tabs-pro-link col-md-3 col-xs-12">FANS CLUB</a>
                                <a href="<?php echo site_url()."/profile"; ?>" class="tabs-pro-link col-md-3 col-xs-12">EVENTS</a>
                            </div>
                            <div class="tab-wraps" id="tabs-1">
                                <div class="tabcontents">
                                    <a href="#rat-popup" class="btn-vew"><i class="fa fa-plus"></i>Add Music</a>

                                    <div id="rat-popup" class="rat-overlay over-scr">
                                      <?php echo do_shortcode( '[cr_song_form]' ); ?>
                                    </div>

                                    <div class="tab_body">
                                      <div class="row">
                                        <div class="col-xs-12 pl0">
                                            <div class="blog-container">
                                            
                   							<ul class="wpc-box-list">
                    
            <?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;  
			$args = array(
			'post_type' => 'song',
			'posts_per_page' => 3,
			'post_status' =>  array( 'publish', 'draft'),
			'author' => $current_user->ID,
  			'paged'=> $paged	
			);
			$query = new WP_Query( $args );
			/*echo "<pre>";
			print_r($query);
			echo "</pre>";*/
			if(!empty($query->posts))
			{	  
			    foreach($query->posts as $song)
			{
			    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $song->ID ), array(50,50) );
			    $strFile = get_post_meta($song -> ID, $key = 'mp3_file', true);
			    $movie_name = get_post_meta($postDetails -> ID, $key = 'movie_name', true);
			    //$terms = get_the_terms( $song -> ID, 'song-category' );              
			?>
                    
                   <li class="wpc-box-item" >
                     <ol>
                        <li class="bx-item-t">
                          <?php if(!empty($image[0])) {?>
                          <img src="<?php echo $image[0]; ?>" alt="<?php echo $song->post_title; ?>">
                          <?php }else{ ?> 
                          <img src="<?php echo get_template_directory_uri(); ?>/images/poster/poster-1(58X87).jpg" alt="<?php echo $song->post_title; ?>">
                          <?php } ?>
                        </li>
                        <li class="bx-item-c"></li>
                        <li class="bx-item-title">
                           <h4><?php echo $song->post_title; ?></h4>
                           <span><?php echo $movie_name; ?></span>
                        </li>
                        <li class="bx-item-d">
                           <?php /*<button type="button" id="button_play" class="btn btn-pl" onclick='buttonPlayPress()'>
                           <i class="fa fa-play"></i>
                           </button>
                           <button type="button" id="button_stop" class="btn btn-pl" onclick='buttonStopPress()'>
                           <i class="fa fa-stop"></i>
                           </button>*/                
                           echo do_shortcode('[sc_embed_player fileurl="'.$strFile.'"]');
                           ?> 
                        </li>
                        <div style="clear:both;"></div>
                       <?php 
                       $salt="MY_SECRET_STUFF";
                       $encrypted_id = base64_encode($song->ID . $salt);
                       ?>
                       <li><span class="poststatus"><?php echo $song->post_status; ?></span><a href="<?php echo site_url()."/edit?postId=".$encrypted_id; ?>" class="btn-vew" target="_blank">Edit</a><br>&nbsp;&nbsp;<a href="<?php echo site_url()."/song-edit/?action=remove&postId=".$encrypted_id; ?>" class="btn-vew" onclick="return confirm('Are you sure to remove <?php echo $song->post_title; ?> ?')">Remove</a></li>
                     </ol>
                  </li>
                        
         <?php }}else { echo "<div class='noresult'>No result found.</div>"; } ?>                 
                    </ul>
                                                

                                            </div>
                                            
                                            <?php if(!empty($query->posts)) { ?>
                <div class="post-navigation mv3">
                    <ul>
                        <li><?php previous_posts_link( '&laquo; PREV', $query->max_num_pages) ?></li>
        				<li><?php next_posts_link( 'NEXT &raquo;', $query->max_num_pages) ?></li>
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
