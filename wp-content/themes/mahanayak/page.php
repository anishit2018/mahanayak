<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<section class="section-content pv12" data-bg-image="<?php echo get_template_directory_uri(); ?>/images/coming-bg.jpg">
    <div class="container">
        <div class="row">

        </div>
    </div>
    <div class="container">
        
        <div class="clearfix"></div>
        <?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/page/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
		?>
		<div class="clearfix"></div>
		
    </div>
</section>          

<?php get_footer();