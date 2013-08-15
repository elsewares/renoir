<div class="images form">
<?php echo $this->Form->create('Image');?>
	<fieldset>
		<legend><?php echo __('Add Image'); ?></legend>
	<?php
		echo $this->Form->input('artwork_id');
		echo $this->Form->input('path');
		echo $this->Form->input('featured');
		echo $this->Form->input('filetype');
		echo $this->Form->input('filesize');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Images'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Artworks'), array('controller' => 'artworks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Artwork'), array('controller' => 'artworks', 'action' => 'add')); ?> </li>
	</ul>
</div>
