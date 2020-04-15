  <?php
    $heading = get_sub_field('heading');
    $id = get_sub_field('id');
    $content = get_sub_field('content');
    $diagram = get_sub_field('diagram');
  ?>

  <div class="flexible-diagram" id="<?php echo $id; ?>">
    <section class="intro">
      <h2><?php echo $heading; ?></h2>
      <?php echo $content; ?>
    </section>
    <section class="diagram">
      <?php echo $diagram; ?>
    </section>
  </div>
