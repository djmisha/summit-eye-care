  <?php
    $id = get_sub_field('id');
   ?>
  <section class="flexible-multicolumn" id="<?php echo $id; ?>">
    <?php if( have_rows('columns') ): ?>
      <?php while( have_rows('columns') ): the_row();
        $heading = get_sub_field('heading');
        $content = get_sub_field('content');
      ?>

      <div class="column-section corner-mark">
        <?php if(!empty($heading) ): ?>
          <h2 class="review"><?php echo $heading; ?></h2>
          <?php if( ($content) ) echo $content; ?>
        <?php endif; ?>
      </div>

      <?php endwhile; ?>
    <?php endif; ?>


  </section>