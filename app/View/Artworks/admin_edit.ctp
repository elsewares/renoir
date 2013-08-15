<div class="artworks form">
<?php echo $this->Form->create('Artwork');?>
	<fieldset>
		<legend><?php echo __('Admin Edit Artwork'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('artist_id');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('dimensions');
		echo $this->Form->input('pieces');
		echo $this->Form->input('price');
		echo $this->Form->input('rental_only');
		echo $this->Form->input('custom');
		echo $this->Form->input('prints');
		echo $this->Form->input('print_price');
		echo $this->Form->input('is_submission');
		echo $this->Form->input('active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Artwork.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Artwork.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Artworks'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Artists'), array('controller' => 'artists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Artist'), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Images'), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image'), array('controller' => 'images', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rentals'), array('controller' => 'rentals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rental'), array('controller' => 'rentals', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('controller' => 'order_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Items'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
