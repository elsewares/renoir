<div class="orderItems form">
<?php echo $this->Form->create('OrderItem');?>
	<fieldset>
		<legend><?php echo __('Add Order Item'); ?></legend>
	<?php
		echo $this->Form->input('order_id');
		echo $this->Form->input('artwork_id');
		echo $this->Form->input('item_type');
		echo $this->Form->input('amount');
		echo $this->Form->input('charges');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Order Items'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Artworks'), array('controller' => 'artworks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Artwork'), array('controller' => 'artworks', 'action' => 'add')); ?> </li>
	</ul>
</div>
