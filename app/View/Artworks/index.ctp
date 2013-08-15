<div class="artworks index">
	<div class="artwork gallery">
		<?php $row = 0; echo '<div class="row">'; ?>
		<?php foreach ($artworks as $artwork): ?>
				<?php echo $this->element('Artworks/gallery', array('artwork' => $artwork)); $row++; ?>
			<?php if($row % 3 == 0) echo '</div><div class="row">'; ?>
		<?php endforeach; echo '</div>'; ?>
	</div>
	<div class="gallery controls">
		<p><?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}')));	?></p>
		<div class="paging">
		<?php
			echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
			echo $this->Paginator->numbers(array('separator' => ' ~ '));
			echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		?>
		</div>
	</div>
</div>

