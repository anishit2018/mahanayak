<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<section class="section-content pv12 bg-cover" data-bg-image="images/poster/poster-1.jpg">
   <div class="container">
      <div class="row">      
         <div class="col-md-12">
            <article class="blog-item single" >
            
            <?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
		  
		    $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
			//echo $image[0]
			$imageUrl = $image[0]; 
		    $categories = get_the_category(get_the_ID());
		  	$allcategory = array();
				if(!empty($categories))
				{
					foreach($categories as $category)
					{
						$allcategory[] = $category->name;
					}	
				}
			$comments_count = wp_count_comments(get_the_ID());
			$tot_comments = $comments_count->total_comments;
		  
		 ?>
            
               <div class="col-md-8 col-sm-8">
                  <?php if(!empty($imageUrl)) {?>
                  <div class="col-md-12 col-sm12">
                     <div class="row"><img class=" post-image hover-dark" src="<?php echo $imageUrl; ?>" width="100%"></div>
                  </div>
                  <?php } ?>
                  <div class="col-md-12 col-sm-12 col-xs-12 ph0">
                     <div class="post-content bg-cover">
                        <div class="content-meta">
                           <h2 class="entry-title"><?php echo get_the_title(); ?>
                           </h2>
                           <div class="social-links">
                              	 <a href="http://www.facebook.com/sharer.php?u=<?php echo get_the_permalink(get_the_ID()); ?>&t=<?php echo get_the_title(); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                                 <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( get_the_title() ) ?>&amp;url=<?php echo urlencode( get_the_permalink(get_the_ID()) ); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                                 <a href="https://plus.google.com/share?url=<?php echo get_the_permalink(get_the_ID()); ?>" target="_blank"><i class="fa fa-user"></i></a>
                           </div>
                        </div>
                        <p class="entry-text"><?php echo get_the_content(); ?></p>                        
                     </div>
                  </div>
    <div class="container  pvt80 col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <div id="respond" class="comment-respond">
                    <h3 id="reply-title" class="comment-reply-title">Leave a comment</h3>
                    <?php
                     $fields =  array(
                         
                         'author' =>
                         '<p class="comment-form-author">'.
                         '<input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                         '" size="30"' . $aria_req . ' /></p>',
                         
                         'email' =>
                         '<div class="col-md-6"><div class="form-group"><label class="ui-form__label">' . __( 'Email address', 'domainreference' ) .
                         ( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
                         '<input id="email" name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                         '" size="30"' . $aria_req . ' /></div></div>',
                         
                         
                     );
                     
                     $comments_args = array(
                         'id_form'           => 'commentform',
                         'class_form'      => 'comment-form',
                         'id_submit'         => 'submit',
                         'class_submit'      => 'submit btn btn-lg btn-info btn-effect',
                         'name_submit'       => 'submit',
                         'title_reply'       => __( '' ),
                         'title_reply_to'    => __( '' ),
                         'cancel_reply_link' => __( 'Cancel Reply' ),
                         'label_submit'      => __( 'Post Comment' ),
                         'format'            => 'xhtml',
                         
                         'comment_field' =>  '<textarea id="comment" name="comment" class="cmm-box rs-size" >' .
                         '</textarea>',
                         
                         'must_log_in' => '<p class="must-log-in">' .
                         sprintf(
                             __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
                             wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
                             ) . '</p>',
                         
                         'logged_in_as' => '',
                         
                         'comment_notes_before' => '',
                         
                         'comment_notes_after' => '',
                         
                         'fields' => apply_filters( 'comment_form_default_fields', $fields ),
                     );
                     
                     comment_form($comments_args, get_the_ID());
                     
                     ?>
                    <?php /*<form id="commentform" class="comment-form" novalidate="">
                        <div class="row">
                            <p class="comment-form-author">
                                <input id="author" name="author" type="text" value="" size="30" placeholder="Name *">
                            </p>
                            <p class="comment-form-email">
                                <input id="email" name="email" type="email" value="" size="30" placeholder="E-mail *">
                            </p>
                            <p class="comment-form-comment">
                            <textarea id="comment" name="comment" placeholder="Comments"></textarea>
                            </p>
                            <p class="form-submit">
                            <button type="submit" class="button fill rectangle fr">Send to us</button>
                            </p> 
                        </div>
                                           
                    </form>*/ 
                     echo do_shortcode('[WPLIKE post_id="'.get_the_ID().'"]');
                     ?>
                </div>
            </div> 
            <div class="col-sm-12">
                <div id="comments" class="comments-area">
                    <div class="comments-wrapper">
                        <h2 class="comments-title pvt40">Comments (<?php echo $tot_comments; ?>)</h2>
                        <ol class="comment-list">
                        <?php
            				$args = array(					
            				    'post_id' => get_the_ID(), // use post_id, not post_ID
            				    'status' => 'Approved',
            				);
            				$comments = get_comments($args);
            				foreach($comments as $comment) :  
            			?>
                            <li>
                                <article>
                                    <div class="comment-avatar">
                                        <?php echo get_avatar( $comments->user_id, 32 );  ?>
                                    </div>
                                    <div class="comment-body">
                                        <div class="meta-data">
                                            <?php echo $comment->comment_author; ?>
                                            <span><?php echo date('d/M/Y h:i:s',strtotime($comment->comment_date)); ?></span>
                                        </div>
                                        <div class="comment-content">
                                            <?php echo $comment->comment_content; ?>
                                        </div>
                                    </div>
                                </article>
                            </li>
                        <?php endforeach; ?>  
                        </ol>
                    </div>
                </div>
            </div>   
            
        </div>
    </div>
               </div>
               <?php
		  endwhile; // End of the loop.
		 ?>
               <div class="col-sm-4">
                  <?php get_sidebar(); ?>
               </div>
         </div>
         </article>  
      </div>
   </div>
   </div> 
</section>
<div class="section-content pvb0">
    
</div>


			<?php
			/* Start the Loop */
			/*while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/post/content', get_post_format() );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				the_post_navigation( array(
					'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'twentyseventeen' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'twentyseventeen' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
				) );

			endwhile; // End of the loop.*/
			?>

		
<?php get_footer();
