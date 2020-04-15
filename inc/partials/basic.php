<?php
  $heading = get_sub_field('heading');
  $content = get_sub_field('content');
  $background = get_sub_field('background');
  $id = get_sub_field('id');
?>
<!-- Basic Section -->
  <section class="basic-content" id="<?php echo $id; ?>" <?php if( $background ): ?> style="background-image: url(<?php echo $background; ?>);"<?php endif; ?>>
    <h2><?php echo $heading; ?></h2>
    <?php echo $content; ?>
  </section>
<!-- End Basic Section -->