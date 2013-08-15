<div class="artworks featured" style="width: 950px; height: 340px; position: relative; left: -10px;">
	<?php $row = 0; echo '<div class="row">'; ?>
	<?php foreach ($artworks as $artwork): ?>
			<?php echo $this->element('Artworks/featured', array('artwork' => $artwork)); $row++; ?>
		<?php if($row % 3 == 0) echo '</div><div class="row">'; ?>
	<?php endforeach; echo '</div>'; ?>
</div>