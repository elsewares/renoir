<?php for($loop = 0; $loop < 3; $loop++): ?>
	<div class="uploads form upload-<?php echo $loop; ?>">
	<?php echo $this->Form->create('Upload', array('type' => 'file'));?>
		<fieldset>
			<legend><?php echo __('Upload ' . $this->Ordinal->addSuffix($loop + 1) . 'submission image'); ?></legend>
		<?php
			echo $this->Form->input('Artwork.title');
			echo $this->Form->input('Artwork.description');
			echo $this->Form->input('Artwork.dimensions');
			echo $this->Form->input('Artwork.pieces');
			echo $this->Form->input('Artwork.custom', array('type' => 'checkbox'));
			echo $this->Form->input('Image.filename', array('type' => 'file'));
			echo $this->Form->hidden('Image.dir');
			echo $this->Form->hidden('Image.mimetype');
			echo $this->Form->hidden('Image.filesize');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit Artwork'), array('class' => 'btn'));?>
	</div>
	<div class="upload-<?php echo $loop; ?> upload-status"></div>
<?php endfor; ?>