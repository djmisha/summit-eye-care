<ul id="tabs">
	<?php
	foreach ($tax_terms as $term):
		$slug = preg_replace('/(\d-)/i', '', $term->slug);
		?>
			<li><a href="#tabs" id="<?php echo $slug;?>"><?php echo $term->name?></a></li>
		<?php
	endforeach;
	?>
</ul>