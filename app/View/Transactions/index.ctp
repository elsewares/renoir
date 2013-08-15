<div class="transactions index">
	<h2><?php echo __('Transactions');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('uuid');?></th>
			<th><?php echo $this->Paginator->sort('approval');?></th>
			<th><?php echo $this->Paginator->sort('order_id');?></th>
			<th><?php echo $this->Paginator->sort('client_id');?></th>
			<th><?php echo $this->Paginator->sort('settled');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($transactions as $transaction): ?>
	<tr>
		<td><?php echo h($transaction['Transaction']['id']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['uuid']); ?>&nbsp;</td>
		<td><?php echo h($transaction['Transaction']['approval']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($transaction['Order']['order_id'], array('controller' => 'orders', 'action' => 'view', $transaction['Order']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($transaction['Client']['name'], array('controller' => 'clients', 'action' => 'view', $transaction['Client']['id'])); ?>
		</td>
		<td><?php echo h($transaction['Transaction']['settled']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $transaction['Transaction']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $transaction['Transaction']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $transaction['Transaction']['id']), null, __('Are you sure you want to delete # %s?', $transaction['Transaction']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Transaction'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
	</ul>
</div>
