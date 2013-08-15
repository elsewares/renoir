<div class="orderItems view">
<h2><?php  echo __('Order Item');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($orderItem['OrderItem']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order'); ?></dt>
		<dd>
			<?php echo $this->Html->link($orderItem['Order']['order_id'], array('controller' => 'orders', 'action' => 'view', $orderItem['Order']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Artwork'); ?></dt>
		<dd>
			<?php echo $this->Html->link($orderItem['Artwork']['title'], array('controller' => 'artworks', 'action' => 'view', $orderItem['Artwork']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item Type'); ?></dt>
		<dd>
			<?php echo h($orderItem['OrderItem']['item_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($orderItem['OrderItem']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Charges'); ?></dt>
		<dd>
			<?php echo h($orderItem['OrderItem']['charges']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Order Item'), array('action' => 'edit', $orderItem['OrderItem']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Order Item'), array('action' => 'delete', $orderItem['OrderItem']['id']), null, __('Are you sure you want to delete # %s?', $orderItem['OrderItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Item'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Artworks'), array('controller' => 'artworks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Artwork'), array('controller' => 'artworks', 'action' => 'add')); ?> </li>
	</ul>
</div>
