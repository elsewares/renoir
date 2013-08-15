<div class="cartItems form">
<?php echo $this->Form->create('CartItem');?>
	<fieldset>
		<legend><?php echo __('Edit Cart Item'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('cart_id');
		echo $this->Form->input('artwork_id');
		echo $this->Form->input('item_type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('CartItem.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('CartItem.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Cart Items'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Carts'), array('controller' => 'carts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cart'), array('controller' => 'carts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Artworks'), array('controller' => 'artworks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Artwork'), array('controller' => 'artworks', 'action' => 'add')); ?> </li>
	</ul>
</div>
