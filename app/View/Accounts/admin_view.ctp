<div class="accounts view">
<h2><?php  echo __('Account');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($account['Account']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($account['User']['id'], array('controller' => 'users', 'action' => 'view', $account['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Uuid'); ?></dt>
		<dd>
			<?php echo h($account['Account']['uuid']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Account'), array('action' => 'edit', $account['Account']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Account'), array('action' => 'delete', $account['Account']['id']), null, __('Are you sure you want to delete # %s?', $account['Account']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Account Items'), array('controller' => 'account_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account Item'), array('controller' => 'account_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Account Items');?></h3>
	<?php if (!empty($account['AccountItem'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Account Id'); ?></th>
		<th><?php echo __('Transaction Item Id'); ?></th>
		<th><?php echo __('Amount'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($account['AccountItem'] as $accountItem): ?>
		<tr>
			<td><?php echo $accountItem['id'];?></td>
			<td><?php echo $accountItem['account_id'];?></td>
			<td><?php echo $accountItem['transaction_item_id'];?></td>
			<td><?php echo $accountItem['amount'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'account_items', 'action' => 'view', $accountItem['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'account_items', 'action' => 'edit', $accountItem['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'account_items', 'action' => 'delete', $accountItem['id']), null, __('Are you sure you want to delete # %s?', $accountItem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Account Item'), array('controller' => 'account_items', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
