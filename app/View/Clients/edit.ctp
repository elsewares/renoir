<div class="clients form">
<?php echo $this->Form->create('Client', array('class' => 'form-horizontal'));?>
	<fieldset>
		<legend><?php echo __('Edit Client'); ?></legend>
	<?php
		echo $this->Form->hidden('active', array('value' => true));
		echo $this->Form->input('name');
		echo $this->Form->input('type', array('options' => array('Business', 'Personal'), 'default' => 'Personal'));
		echo $this->Form->input('address1');
		echo $this->Form->input('address2');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('zip');
		echo $this->Form->input('tel', array('placeholder' => '555-555-1212'));
		echo $this->Form->input('email', array('value' => $user['username'], 'disabled' => true));
	?>
		<?php $this->Matisse->submitButton('Save Client Profile'); ?>
	</fieldset>
<?php echo $this->Form->end();?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Client.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Client.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Clients'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rentals'), array('controller' => 'rentals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rental'), array('controller' => 'rentals', 'action' => 'add')); ?> </li>
	</ul>
</div>
