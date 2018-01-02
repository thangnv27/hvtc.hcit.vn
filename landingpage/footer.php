<section id="footer">
    <div class="widget-areas">
        <div class="container">
            <?php echo wpautop(stripslashes(get_option("footer_info"))); ?>
        </div>
    </div>
    <div class="copyright">
        <?php
        $copyright = get_option('copyright_text');
        if(!empty($copyright)):
        ?>
        <span>Copyright &copy; <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo $copyright; ?>"><?php echo $copyright; ?></a>. All rights reserved. </span>
        <a href="http://ppo.vn" title="Thiết kế web chuyên nghiệp" target="_blank"><?php _e('Thiết kế web bởi PPO.VN', SHORT_NAME) ?></a>
        <?php else: ?>
        <span>Copyright &COPY; <a href="http://ppo.vn" title="Thiết kế website">PPO.VN</a>. All rights reserved.</span>
        <?php endif; ?>
    </div>
</section>

<?php if(!wp_is_mobile()): ?>
<div id="scroll-to-top"></div>
<?php endif; ?>

<?php wp_footer(); ?>
<div id="fb-root"></div>
<script>
Modernizr.load({
    load: [
        '<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css',
        '<?php echo get_template_directory_uri(); ?>/css/animate.min.css',
        '<?php echo get_template_directory_uri(); ?>/css/addquicktag.min.css',
        '<?php echo get_template_directory_uri(); ?>/css/wp-default.min.css',
//        'https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js',  
//        '<?php echo get_template_directory_uri(); ?>/js/jquery.min.js',
//        '<?php echo get_template_directory_uri(); ?>/js/jquery-migrate.min.js',
        '<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js',
//        '<?php echo get_template_directory_uri(); ?>/js/custom.min.js',
        '<?php echo get_template_directory_uri(); ?>/js/app.js'
//        '<?php echo includes_url('js/wp-embed.min.js'); ?>'
    ]
});
</script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
</body>
</html>