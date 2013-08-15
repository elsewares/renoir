<div class="carts index">
	<h2><?php echo __('Carts');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('session_id');?></th>
			<th><?php echo $this->Paginator->sort('client_id');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($carts as $cart): ?>
	<tr>
		<td><?php echo h($cart['Cart']['id']); ?>&nbsp;</td>
		<td><?php echo h($cart['Cart']['session_id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($cart['Client']['name'], array('controller' => 'clients', 'action' => 'view', $cart['Client']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $cart['Cart']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $cart['Cart']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $cart['Cart']['id']), null, __('Are you sure you want to delete # %s?', $cart['Cart']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Cart'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Cake Sessions'), array('controller' => 'cake_sessions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Session'), array('controller' => 'cake_sessions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cart Items'), array('controller' => 'cart_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cart Item'), array('controller' => 'cart_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
