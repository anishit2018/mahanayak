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

<section class="section-content pv12 bg-cover fullscreen-section bg-black pvb0">
    <div class="container wpc-boxoffice pvb40">
                 <div class="col-sm-12 page-title mt5 mb5">
                <h1 class="blog-title">Music Collection</h1>
            </div>
                <!--<ol class="breadcrumb">
                    <li><a href="index.html" class="active">Home</a></li>
                    <li><a href="blog.html">Blog</a></li>
                </ol>-->
    
        <div class="row"> 
            <div class="col-sm-8 col-xs-12">
                    <ul class="wpc-box-list">
                    
            <?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;  
			$args = array(
			'post_type' => 'song',
			'posts_per_page' => 3,
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
			    $movie_name = get_post_meta($song -> ID, $key = 'movie_name', true);
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
                     </ol>
                  </li>
                        
         <?php }}else { echo "<div class='noresult'>No result found.</div>"; } ?>                 
                    </ul>
                    
                    <div class="clearfix"></div>
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

