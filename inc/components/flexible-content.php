<!-- Flexible Content -->

<!-- check if the flexible content field has rows of data -->
<?php if( class_exists('acf') ): ?>

<?php if( have_rows('page_sections') ): ?>
<!-- loop through the rows of data -->
  <?php while ( have_rows('page_sections') ) : the_row(); ?>

    <?php if( get_row_layout() == 'feature' ): ?>
      <?php require  __DIR__ . '/../partials/styled.php'; ?>

    <?php elseif( get_row_layout() == 'basic_content' ): ?>
      <?php require  __DIR__ . '/../partials/basic.php'; ?>

    <?php elseif( get_row_layout() == 'bna' ): ?>
      <?php require  __DIR__ . '/../partials/bna.php'; ?>

    <?php elseif( get_row_layout() == 'multi_column' ): ?>
      <?php require  __DIR__ . '/../partials/multi-column.php'; ?>

    <?php elseif( get_row_layout() == 'diagram' ): ?>
      <?php require  __DIR__ . '/../partials/diagram.php'; ?>

    <?php elseif( get_row_layout() == 'testimonial' ): ?>
      <?php require  __DIR__ . '/../partials/testimonial.php'; ?>

    <?php elseif( get_row_layout() == 'contact_us' ): ?>
      <?php require  __DIR__ . '/../partials/contact.php'; ?>

		<?php endif; ?>
  <?php endwhile; ?>
<!-- no layouts found -->
  <?php else : ?>
    <section class="basic-content">
      <?php the_content(); ?>
    </section>
  <?php endif; ?>

<?php endif; ?>
<!-- End Flexible Content-->