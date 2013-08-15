<div class="orders view">
<h2><?php  echo __('Order');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($order['Order']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order Id'); ?></dt>
		<dd>
			<?php echo h($order['Order']['order_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client'); ?></dt>
		<dd>
			<?php echo $this->Html->link($order['Client']['name'], array('controller' => 'clients', 'action' => 'view', $order['Client']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Order'), array('action' => 'edit', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Order'), array('action' => 'delete', $order['Order']['id']), null, __('Are you sure you want to delete # %s?', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('controller' => 'order_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Item'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Order Items');?></h3>
	<?php if (!empty($order['OrderItem'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Order Id'); ?></th>
		<th><?php echo __('Artwork Id'); ?></th>
		<th><?php echo __('Item Type'); ?></th>
		<th><?php echo __('Amount'); ?></th>
		<th><?php echo __('Charges'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($order['OrderItem'] as $orderItem): ?>
		<tr>
			<td><?php echo $orderItem['id'];?></td>
			<td><?php echo $orderItem['order_id'];?></td>
			<td><?php echo $orderItem['artwork_id'];?></td>
			<td><?php echo $orderItem['item_type'];?></td>
			<td><?php echo $orderItem['amount'];?></td>
			<td><?php echo $orderItem['charges'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'order_items', 'action' => 'view', $orderItem['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'order_items', 'action' => 'edit', $orderItem['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'order_items', 'action' => 'delete', $orderItem['id']), null, __('Are you sure you want to delete # %s?', $orderItem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Order Item'), array('controller' => 'order_items', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
