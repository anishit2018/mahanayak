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
            <h1 class="blog-title">Fan's Club</h1>
        </div>
        <!--<ol class="breadcrumb">
                    <li><a href="index.html" class="active">Home</a></li>
                    <li><a href="blog.html">Blog</a></li>
                </ol>-->

        <div class="row">
            <div class="col-sm-8 col-xs-12 pl0">
                <div class="blog-container">
                
            <?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;  
			$args = array(
			'post_type' => 'fans-club',
			'posts_per_page' => 3,
  			'paged'=> $paged	
			);
			$query = new WP_Query( $args );
			/*echo "<pre>";
			print_r($query);
			echo "</pre>";*/
			if(!empty($query->posts))
			{	  
			foreach($query->posts as $fans)
			{
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $fans->ID ), 'thumbnail' );
			//echo $image[0]
			$imageUrl = $image[0]; 
			$author_id=$fans->post_author;
			$comments_count = wp_count_comments($fans->ID);
			$tot_comments = $comments_count->total_comments;
			?>
                    
                   <article class="blog-item mt35">
                     <div class="col-sm-4 col-xs-12">
                        <?php if(!empty($image[0])) { ?>
                        <a href="<?php echo get_the_permalink($fans->ID); ?>" class="rp-media">
    						<img src="<?php echo $image[0]; ?>" alt="<?php echo $fans->post_title; ?>">
    					</a>
    					<?php } else { ?>
    					<a href="<?php echo get_the_permalink($fans->ID); ?>" class="rp-media">
    						<img src="<?php echo get_template_directory_uri(); ?>/images/post-thumb.jpg" alt="<?php echo $fans->post_title; ?>">
    					</a>
    					<?php }?>
                     </div>
                     <div class="col-sm-8 ml-r-15">
                        <div class="post-content">
                           <div class="entry-meta">
                              <ul class="category">
                                 <li><a href="<?php echo get_the_permalink($fans->ID); ?>"><?php the_author_meta( 'user_nicename' , $author_id ); ?></a></li>
                                 <li><a href="<?php echo get_the_permalink($fans->ID); ?>"><?php echo date('d M Y',strtotime($fans->post_date)); ?></a></li>                                 
                              </ul>
                              <div class="social-links">
                                 <a href="http://www.facebook.com/sharer.php?u=<?php echo get_the_permalink($fans->ID); ?>&t=<?php echo $fans->post_title; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                                 <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( $fans->post_title ) ?>&amp;url=<?php echo urlencode( get_the_permalink($fans->ID) ); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                                 <a href="https://plus.google.com/share?url=<?php echo get_the_permalink($fans->ID); ?>" target="_blank"><i class="fa fa-user"></i></a>
                              </div>
                           </div>
                           <h2 class="entry-title"><a href="<?php echo get_the_permalink($fans->ID); ?>"><?php echo $fans->post_title; ?></a>
                           </h2>
                           <p class="entry-excepts"><?php  echo substr($fans->post_content,0,100); ?></p>
                           <a href="<?php echo get_the_permalink($fans->ID); ?>" class="btn more mt1"> Read more</a>
                           <div class="social-icon mt1">
                              <span><?php echo do_shortcode('[WPLIKE post_id="'.$fans->ID.'"]'); ?></span>
                              <span><i class="fa fa-comment-o"></i><?php echo $tot_comments; ?></span>
                           </div>
                        </div>
                     </div>
                  </article>
                    
              <?php }}else { echo "<div class='noresult'>No result found.</div>"; } ?>      
                    
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
            <div class="col-sm-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
        </div>        
</section>


<?php get_footer();

