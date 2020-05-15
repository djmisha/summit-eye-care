<?php
	// Template Name: Home
?>
<?php get_header()?>


<div class="home-welcome">
    <div class="owl-carousel home-rotator">
        <?php if(have_rows('slide_show')): ?>
        <?php while(have_rows('slide_show')): the_row(); ?>
        <div class="slide" style="background-image: url('<?php the_sub_field('image'); ?>');">
        </div>
        <?php endwhile; ?>
        <?php endif; ?>
    </div>
    <div class="taglines">
        <span class="taglines-title"><?php the_field('headline'); ?></span>
        <span class="taglines-subtitle"><?php the_field('subheadline'); ?></span>
        <a href="<?php bloginfo('url'); ?>/contact-us/" class="button" rel="nofollow">Schedule a Consultation</a>
    </div>
</div>


<section class="home-whychoose">
    <p><?php the_field('about_headline'); ?></p>
    <div class="home-reasons">
        <?php if(have_rows('about_items')): ?>
        <?php while(have_rows('about_items')): the_row(); ?>
        <div class="reason">
            <img src="<?php the_sub_field('image'); ?>" alt="">
            <span class="headline"><?php the_sub_field('headline'); ?></span>
            <span class="subheadline"><?php the_sub_field('content'); ?></span>
            <a href="<?php the_sub_field('link'); ?>" class="button button-white"
                rel="nofollow"><?php the_sub_field('link_text'); ?></a>
        </div>
        <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>


<section class="home-surgery">
    <h2><?php the_field('surgery_headline'); ?></h2>
    <div class="surgery">
        <?php if(have_rows('surgery_items')): ?>
        <?php while(have_rows('surgery_items')): the_row(); ?>
        <div class="surgery-single">
            <div class="lines"></div>
            <a href="<?php the_sub_field('link'); ?>"><img src="<?php the_sub_field('image'); ?>" alt="icon"></a>
            <a href="<?php the_sub_field('link'); ?>" rel="nofollow"
                class="button button-white"><?php the_sub_field('headline'); ?></a>
        </div>
        <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>


<section class="home-doctors">
    <h2><?php the_field('doctor_headline'); ?></h2>
    <?php if(have_rows('doctor_items')): ?>
    <?php while(have_rows('doctor_items')): the_row(); ?>
    <div class="doctor">
        <div class="doc-pic">
            <img src="<?php the_sub_field('image'); ?>" alt="<?php the_sub_field('headline'); ?>">
        </div>
        <div class="doc-bio">
            <h3><?php the_sub_field('headline'); ?></h3>
            <?php the_sub_field('content'); ?>
            <div class="doc-button">
                <a href="<?php the_sub_field('link'); ?>" rel="nofollow" class="button button-transparent">View Bio</a>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
    <?php endif; ?>
</section>


<section class="home-testis">
    <div class="owl-carousel testi-slider">
        <?php if(have_rows('testimonials')): ?>
        <?php while(have_rows('testimonials')): the_row(); ?>
        <div class="testi-slider-squote">
            <?php the_sub_field('content'); ?>
        </div>
        <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>


<section class="home-with-image"></section>

<?php get_footer()?>