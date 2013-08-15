<div class="locations form">
<?php echo $this->Form->create('Location');?>
	<fieldset>
		<legend><?php echo __('Admin Edit Location'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('client_id');
		echo $this->Form->input('alias');
		echo $this->Form->input('address1');
		echo $this->Form->input('address2');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('zip');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Location.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Location.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Locations'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rentals'), array('controller' => 'rentals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rental'), array('controller' => 'rentals', 'action' => 'add')); ?> </li>
	</ul>
</div>
