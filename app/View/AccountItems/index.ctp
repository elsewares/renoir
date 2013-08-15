<div class="accountItems index">
	<h2><?php echo __('Account Items');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('account_id');?></th>
			<th><?php echo $this->Paginator->sort('transaction_item_id');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($accountItems as $accountItem): ?>
	<tr>
		<td><?php echo h($accountItem['AccountItem']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($accountItem['Account']['id'], array('controller' => 'accounts', 'action' => 'view', $accountItem['Account']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($accountItem['TransactionItem']['transaction_type'], array('controller' => 'transaction_items', 'action' => 'view', $accountItem['TransactionItem']['id'])); ?>
		</td>
		<td><?php echo h($accountItem['AccountItem']['amount']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $accountItem['AccountItem']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $accountItem['AccountItem']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $accountItem['AccountItem']['id']), null, __('Are you sure you want to delete # %s?', $accountItem['AccountItem']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Account Item'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Transaction Items'), array('controller' => 'transaction_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction Item'), array('controller' => 'transaction_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
