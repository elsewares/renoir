<div class="orders view">
<?php if(!isset($cart_empty)): ?>
<?php $order_id = $order['Order']['order_id']; ?>
	<h3><?php  echo __('Order # ' . $order['Order']['order_id']);?></h3>
	<div class="line_items container">
		<?php if (!empty($order_items)):?>
		<?php foreach ($order_items as $orderItem): ?>
			<?php echo $this->element('OrderItems/line_item', array('orderItem' => $orderItem)); ?>
		<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<div class="container">
		<div class="row totals">
			<div class="span3 offset8 total_taxes total">Subtotal: $<?php echo $subtotal; ?></div>
		</div>
		<div class="row totals">
			<div class="span3 offset8 total_taxes total">Taxes: $<?php echo $total_taxes; ?></div>
		</div>
		<div class="row totals">
			<div class="span3 offset8 total_amount total">Total: $<?php echo $total; ?></div>
		</div>
		<div class="orders preview actions">
			<?php if($is_client == true): ?>
				<?php echo $this->element('Transactions/POST_form', array('user_id' => $user['id'], 'total' => $total, 'taxes' => $total_taxes, 'order_id' => $order['Order']['order_id'])); ?>
			<?php else: ?>
				<?php echo $this->Html->link('Register as a Client', $this->Matisse->wpLink('client-registration/') , array('class' => 'btn btn-danger')); ?>
			<?php endif; ?>
				<?php echo $this->Html->link('Back to the Gallery', $this->Matisse->wpLink('gallery/') , array('class' => 'btn btn-danger', 'target' => '_parent')); ?>
		</div>
	</div>
<?php else: ?>
	<h3 class="dk-red">Your cart is empty.</h3>
	<?php echo $this->Html->link('Go to the Gallery', $this->Matisse->wpLink('gallery/'), array('class' => 'btn btn-danger', 'target' => '_parent')); ?>
</div>
<?php endif ?>
