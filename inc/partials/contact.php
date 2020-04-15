<?php
  $heading = get_sub_field('heading');
  $content = get_sub_field('content');
  $background = get_sub_field('background');
  $text = get_sub_field('text');
?>

<!--googleoff: index-->

<!-- Basic Section -->
  <section class="flexible-contact"<?php if( $background ): ?> style="background-image: url(<?php echo $background; ?>);"<?php endif; ?>>
    <div class="contact-content">
    	<h2><?php the_field('contact_label', 'option'); ?></h2>

      <?php if( have_rows('locations', 'option')): ?>
        <?php while( have_rows('locations', 'option')): the_row();
          $phone = get_sub_field('phone', 'options');
          $tel = str_replace(array('.', ',', '-', '(', ')'), '' , $phone);
        ?>
          <div class="touch-button-text">
            <a href="tel:1<?php echo $tel; ?>" data-label="Header - Phone number" class="track-outbound">
              <i class="fas fa-mobile-alt phone-icon"></i>
              <span><?php echo $phone; ?></span>
            </a>
          </div>

        <?php endwhile; ?>
      <?php endif; ?>
      <div class="contact-text">
        <?php echo $text; ?>
      </div>

    </div>
    <div class="flex-form">
      <?php echo do_shortcode( '[seaforms name="procedure_contact"]' ); ?>
    </div>
  </section>
<!-- End Basic Section -->

<!--googleon: index>