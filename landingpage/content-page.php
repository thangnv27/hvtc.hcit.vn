<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php the_content(); ?>

    <?php 
    $frm = get_field("frm_reg");
    if($frm){
        $shortcode = '[contact-form-7 id="' . $frm->ID . '" title="' . $frm->post_title . '"]';
    ?>
    <div class="frm-register-wrap">
        <div class="head-title">
            ĐĂNG KÝ NHẬN TƯ VẪN MIỄN PHÍ<br/>
            <span>HOTLINE: <a href="tel:<?php echo get_option('hotline') ?>"><?php echo get_option('hotline') ?></a></span>
        </div>
        <?php echo do_shortcode($shortcode); ?>
    </div>
    <?php } ?>
</article><!-- #post -->