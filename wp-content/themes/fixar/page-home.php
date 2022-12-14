<?php
/**
 * The home template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Template Name: Home
 *
 */
 
 
 
?>
<?php get_header();?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <div class="tmpl-home home-template ">
    	<div class="container">
	        <?php the_content(); ?>
    	</div>
    </div>
      
<?php endwhile; ?>	

<?php get_footer(); ?>