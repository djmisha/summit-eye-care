<?php get_header()?>


<main class="interior">

    <?php if(have_posts()) : while (have_posts()) : the_post();?>
    <article class="content" id="skiptomaincontent">

        <?php the_content(); ?>

        <div class="the-author">
            The <a href="<?php bloginfo('url'); ?>/about">Doctors at Summit Eye Care of Wisconsin</a> have either
            authored or reviewed and approved this content.
        </div>


        <?php edit_post_link( $link = __('<< EDIT >>'), $before = "<p>", $after ="</p>", $id ); ?>

    </article>
    <?php endwhile; endif;?>

    <?php get_sidebar()?>
</main>

<?php get_footer()?>