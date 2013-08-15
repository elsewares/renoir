<div class="cartItems index">
	<h2><?php echo __('Cart Items');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('cart_id');?></th>
			<th><?php echo $this->Paginator->sort('artwork_id');?></th>
			<th><?php echo $this->Paginator->sort('item_type');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($cartItems as $cartItem): ?>
	<tr>
		<td><?php echo h($cartItem['CartItem']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($cartItem['Cart']['id'], array('controller' => 'carts', 'action' => 'view', $cartItem['Cart']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($cartItem['Artwork']['title'], array('controller' => 'artworks', 'action' => 'view', $cartItem['Artwork']['id'])); ?>
		</td>
		<td><?php echo h($cartItem['CartItem']['item_type']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $cartItem['CartItem']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $cartItem['CartItem']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $cartItem['CartItem']['id']), null, __('Are you sure you want to delete # %s?', $cartItem['CartItem']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Cart Item'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Carts'), array('controller' => 'carts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cart'), array('controller' => 'carts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Artworks'), array('controller' => 'artworks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Artwork'), array('controller' => 'artworks', 'action' => 'add')); ?> </li>
	</ul>
</div>
