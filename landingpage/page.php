<?php get_header(); ?>
<section id="main">
    <div class="container">
        <?php
        while (have_posts()) : the_post();
            // Include the page content template.
            get_template_part('content', 'page');
        endwhile;
        ?>
    </div>
</section>
<?php get_footer(); ?>