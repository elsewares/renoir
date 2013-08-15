<?php for($loop = 0; $loop < 3; $loop++): ?>
	<div class="uploads form upload-<?php echo $loop; ?>">
	<?php echo $this->Form->create('Upload', array('type' => 'file'));?>
		<fieldset>
			<legend><?php echo __('Upload '); ?></legend>
		<?php
			echo $this->Form->input('filename', array('type' => 'file'));
			echo $this->Form->hidden('dir');
			echo $this->Form->hidden('mimetype');
			echo $this->Form->hidden('filesize');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit'));?>
	</div>
	<div class="upload-<?php echo $loop; ?> upload-status"></div>
<?php endfor; ?>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Uploads'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Images'), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image'), array('controller' => 'images', 'action' => 'add')); ?> </li>
	</ul>
</div>
