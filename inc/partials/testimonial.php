<?php
  $testimonial = get_sub_field('testimonial');
  $author = get_sub_field('author');
  $service = get_sub_field('service');
  $id = get_sub_field('id');
?>
<section class="flexible-testimonial" id="<?php echo $id; ?>">
  <blockquote>
    <div class="testimonial-group">
      <?php echo $testimonial; ?>
      <footer><?php echo $author; ?></footer>
      <div class="service"><i class="<?php echo $service; ?>"></i></div>
    </div>
  </blockquote>
</section>