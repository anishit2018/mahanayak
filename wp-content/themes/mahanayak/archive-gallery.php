<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<section class="section-content pv12 bg-cover" data-bg-image="images/coming-bg.jpg">
<div class="container">

  <div class="col-sm-12 page-title mt5 mb5">
                <h1 class="blog-title">Picture Gallery</h1>
            </div>
    <div class="row">
   <div class="col-sm-8 col-xs-12">
    
      <div class="gla">
         <ul>
         <?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;  
			$args = array(
			'post_type' => 'gallery',
			'posts_per_page' => 3,
  			'paged'=> $paged	
			);
			$query = new WP_Query( $args );
			/*echo "<pre>";
			print_r($query);
			echo "</pre>";*/
			if(!empty($query->posts))
			{	  
			    foreach($query->posts as $gallery)
			{
			    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $gallery->ID ), 'thumbnail' );
			    $fullimage = wp_get_attachment_image_src( get_post_thumbnail_id( $gallery->ID ), 'full' );
			    $author_id=$gallery->post_author;
			    $comments_count = wp_count_comments($gallery->ID);
			    $tot_comments = $comments_count->total_comments;
			       
			?>
            <li class="col-xs-6 col-sm-6 col-lg-3">
               <div class="gla-img">
                  <a href="#modal<?php echo $gallery->ID; ?>"><img src="<?php echo $image[0]; ?>" alt="<?php echo $gallery->post_title; ?>"></a>
               </div>
            <!-- start modal--->
            <div class="remodal" data-remodal-id="modal<?php echo $gallery->ID; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
            <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
            <div class="all-remo">
               <p id="modal1Desc">
               <div class="col-sm-7 ph1 col-sm-12">
                  <div class="w3-content w3-display-container">
                     <div class="w3-lft-img">
                        <img class="mySlides" src="<?php echo $fullimage[0]; ?>">                        
                     </div>
                  </div>
               </div>
               <div id="content-1" class="content">
                  <div class="pop-cmm">
                     <div class="comment-avatar">
                        <?php echo get_avatar( $author_id, 32 );  ?>
                        <?php /*<img alt="Image" src="<?php echo get_template_directory_uri(); ?>/images/author.png" class="avatar">*/ ?>
                        <a href="<?php echo site_url(); ?>" class="comment-name"><?php echo get_the_author_meta( 'first_name' , $author_id )." ".get_the_author_meta( 'last_name' , $author_id ); ?></a>
                        <span><?php echo date('d M Y',strtotime($gallery->post_date)); ?></span>
                     </div>
                  </div>
                  <div class="cmm-up-box">
                     <?php echo get_avatar( $author_id, 32 );  ?>
                     <?php /*<img alt="Image" src="<?php echo get_template_directory_uri(); ?>/images/author.png" class="avatar">*/ ?>
                     <p class="up-box-text">
                       <?php echo $gallery->post_content; ?>
                     </p>
                     <div class="share-box">                        
                        <span><i class="fa fa-comment-o"></i><?php echo $tot_comments; ?></span>
                        <span><?php echo do_shortcode('[WPLIKE post_id="'.$gallery->ID.'"]'); ?></span>                     
                     </div>
                  </div>
                  <?php
                $comment_array = get_approved_comments($postID);
                
                /*echo "<pre>";
                print_r($comment_array);
                echo "</pre>";*/
                
				$args = array(					
				    'post_id' => $gallery->ID, // use post_id, not post_ID
				    'status' => 1,
				);
				$comments = get_comments($args);
				foreach($comments as $comment) :  
				?>
                  <div class="cmm-up-box">
                  	<?php echo get_avatar( $comments->user_id, 32 );  ?>                     
                     <p class="up-box-text">
                        <?php echo $comment->comment_content; ?>
                     </p>
                     <!-- <div class="share-box">                        
                        <span><i class="fa fa-comment-o"></i>11</span>
                        <span><i class="fa fa-thumbs-o-up"></i>14</span>
                     </div>-->
                  </div>
                <?php endforeach; ?>  
                  <div class="pop-cmm-box">
                     <?php echo get_avatar( $current_user->ID, 32 );  ?>
                     <form name="frmcustomcomment<?php echo $gallery->ID; ?>" id="frmcustomcomment<?php echo $gallery->ID; ?>" method="post">
                         <div class="comsuccess"></div>
                         <?php if(!is_user_logged_in()) {?>
                         <input type="text" class="cmm-box rs-size" name="author_name<?php echo $gallery->ID; ?>" id="author_name<?php echo $gallery->ID; ?>" value="">
                         <input type="text" class="cmm-box rs-size" name="author_email<?php echo $gallery->ID; ?>" id="author_email<?php echo $gallery->ID; ?>" value="">
                         <?php } else {?>
                         <input type="text" class="cmm-box rs-size" name="author_name<?php echo $gallery->ID; ?>" id="author_name<?php echo $gallery->ID; ?>" value="<?php echo $current_user->user_login; ?>">
                         <input type="text" class="cmm-box rs-size" name="author_email<?php echo $gallery->ID; ?>" id="author_email<?php echo $gallery->ID; ?>" value="<?php echo $current_user->user_email; ?>">
                         <?php } ?>                     
                         <textarea class="cmm-box rs-size" placeholder="Write a comment....." name="user_msg<?php echo $gallery->ID; ?>" id="user_msg<?php echo $gallery->ID; ?>"></textarea>
                         <input type="button" class="comment_submit_class" name="submit1<?php echo $gallery->ID; ?>" id="<?php echo $gallery->ID; ?>" value="Submit">
                     </form>
                  </div>                  
               </div>
               </p>
            </div>            
         </div>
            <!-- end modal -->
            </li>            
         <?php }}else { echo "<li>No result found.</li>"; } ?>            
         </ul>
         
         <div class="cl"></div>
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
   <div class="col-sm-4">
      <?php get_sidebar(); ?>
   </div>
 </div>
</div>
</section>
<?php get_footer(); ?>
<script>
$(document).ready(function(){
	//alert('newwwwwwww');
    $(".comment_submit_class").click(function(){
        
        //console.log($(this).attr('id'));
    	// This does the ajax request
    	
    	var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    	var user_msg = $("#user_msg"+$(this).attr('id')).val();
    	var author_name = $("#author_name"+$(this).attr('id')).val();
    	var author_email = $("#author_email"+$(this).attr('id')).val();
    	alert(author_name);
        $.ajax({
            url: ajaxurl, // or example_ajax_obj.ajaxurl if using on frontend
            data: {
                'action': 'post_ajax_comment',
                'galId' :  $(this).attr('id'),
                'author_name' :  author_name,
                'author_email' :  author_email,
                'user_msg' :  user_msg
            },
            success:function(data) {
                // This outputs the result of the ajax request
                console.log(data);
                $('.cmm-box').val('');                   
                $('.comsuccess').html(data);
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });  
        
    });
});
</script>
