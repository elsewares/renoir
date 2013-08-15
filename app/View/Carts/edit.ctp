<div class="carts form">
<?php echo $this->Form->create('Cart');?>
	<fieldset>
		<legend><?php echo __('Edit Cart'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('session_id');
		echo $this->Form->input('client_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Cart.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Cart.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Carts'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Cake Sessions'), array('controller' => 'cake_sessions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Session'), array('controller' => 'cake_sessions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cart Items'), array('controller' => 'cart_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cart Item'), array('controller' => 'cart_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
