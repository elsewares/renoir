<?php for($loop = 0; $loop < 3; $loop++): ?>
	<div class="uploads form upload-<?php echo $loop; ?>">
	<?php echo $this->Form->create('Upload', array('type' => 'file'));?>
		<fieldset>
			<legend><?php echo __('Upload ' . $this->Ordinal->addSuffix($loop + 1) . 'submission image'); ?></legend>
		<?php
			echo $this->Form->input('filename', array('type' => 'file'));
			echo $this->Form->hidden('dir');
			echo $this->Form->hidden('mimetype');
			echo $this->Form->hidden('filesize');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit'), array('class' => 'btn'));?>
	</div>
	<div class="upload-<?php echo $loop; ?> upload-status"></div>
<?php endfor; ?>