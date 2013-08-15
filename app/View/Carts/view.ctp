<div class="carts view">
<h2><?php  echo __('Cart');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($cart['Cart']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Session Id'); ?></dt>
		<dd>
			<?php echo h($cart['Cart']['session_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cart['Client']['name'], array('controller' => 'clients', 'action' => 'view', $cart['Client']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cart'), array('action' => 'edit', $cart['Cart']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Cart'), array('action' => 'delete', $cart['Cart']['id']), null, __('Are you sure you want to delete # %s?', $cart['Cart']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Carts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cart'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cake Sessions'), array('controller' => 'cake_sessions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Session'), array('controller' => 'cake_sessions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cart Items'), array('controller' => 'cart_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cart Item'), array('controller' => 'cart_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Cart Items');?></h3>
	<?php if (!empty($cart['CartItem'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Cart Id'); ?></th>
		<th><?php echo __('Artwork Id'); ?></th>
		<th><?php echo __('Item Type'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($cart['CartItem'] as $cartItem): ?>
		<tr>
			<td><?php echo $cartItem['id'];?></td>
			<td><?php echo $cartItem['cart_id'];?></td>
			<td><?php echo $cartItem['artwork_id'];?></td>
			<td><?php echo $cartItem['item_type'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'cart_items', 'action' => 'view', $cartItem['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'cart_items', 'action' => 'edit', $cartItem['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'cart_items', 'action' => 'delete', $cartItem['id']), null, __('Are you sure you want to delete # %s?', $cartItem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Cart Item'), array('controller' => 'cart_items', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
