<?php 
/*
  Template Name: Page Builder
 */
get_header(); 
?>
<section id="main">
    <?php
    while (have_posts()) : the_post();
        // Include the page content template.
        get_template_part('content', 'page');
    endwhile;
    ?>
</section>
<?php get_footer(); ?>