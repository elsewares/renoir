<div class="rentals form">
<?php echo $this->Form->create('Rental');?>
	<fieldset>
		<legend><?php echo __('Edit Rental'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('artwork_id');
		echo $this->Form->input('client_id');
		echo $this->Form->input('location_id');
		echo $this->Form->input('transaction_item_id');
		echo $this->Form->input('start_date');
		echo $this->Form->input('end_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Rental.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Rental.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Rentals'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Artworks'), array('controller' => 'artworks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Artwork'), array('controller' => 'artworks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
	</ul>
</div>
