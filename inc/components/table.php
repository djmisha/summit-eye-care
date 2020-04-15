<!-- Table  -->
<section class="flexible-table">
  <?php $table = get_field( 'table' ); ?>
  <?php   if ( $table ): ?>

  <table border="0">
  <?php if ( $table['header'] ): ?>

    <thead>
      <tr>
      <?php foreach ( $table['header'] as $th ): ?>
        <th>
        <?php echo $th['c']; ?>
        </th>
      <?php endforeach; ?>
      </tr>
    </thead>
  <?php endif; ?>

  <tbody>

  <?php foreach ( $table['body'] as $tr ): ?>
    <tr>
    <?php $count = 0;?>
    <?php foreach ( $tr as $td ): ?>
      <td data-title="<?php echo $table['header'][$count]['c'];?>">
      <div><?php echo $td['c'];?></div>
      </td>
      <?php $count++;?>
    <?php endforeach; ?>
    </tr>
  <?php endforeach; ?>

  </tbody>

  </table>
  <?php endif; ?>

  <?php the_sub_field('text'); ?>

</section>
<!-- End Table Section -->