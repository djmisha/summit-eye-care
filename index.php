

<?php
/*

	Main Blog page - .tmpl_type_index

	Blog markup found in blog.php - make chages there.

	The same template is used in archive.php and category.php
	If custom markup is needed for a specific page - index, archive, or category,
	copy markup from blog.php and paste into needed file and make changes there.

*/
?>


<?php get_header(); ?>

<section class="page-title">
  <h1>Blog</h1>
  <?php echo __salaciouscrumb(); ?>
</section>

<?php
	// If needed replace this with the markup from blog.php and add custom markup.
	require  __DIR__ . '/blog.php';
?>

<?php get_footer(); ?>