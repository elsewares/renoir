<div class="orders form">
<?php echo $this->Form->create('Order');?>
	<fieldset>
		<legend><?php echo __('Admin - Add Purchase or Rental'); ?></legend>
	<?php
		echo $this->Form->hidden('order_id', array('value' => $order_id));
		echo $this->Form->input('client_id', array('options' => $clients));
		echo $this->Form->input('admin_client', array('label' => 'Use admin client account?', 'type' => 'checkbox'));
		echo $this->Form->input('Order.OrderItem.artwork_id', array('options' => $artworks));
		echo $this->Form->input('Order.OrderItem.item_type', array('options' => array('rental' => 'Rental', 'purchase' => 'Purchase')));
		echo $this->Matisse->submitButton('Process Order', array('span2 btn-danger'))
	?>
	</fieldset>
<?php echo $this->Form->end();?>
<?php if (isset($order)): ?>
	<?php debug($order, true, true); ?>
	<h3><?php echo 'Order ' . $order . ' created for <span class="dk-red">' . $title . "</span>." ?></h3>
<?php endif; ?>
</div>

