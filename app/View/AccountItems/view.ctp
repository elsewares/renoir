<div class="accountItems view">
<h2><?php  echo __('Account Item');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($accountItem['AccountItem']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Account'); ?></dt>
		<dd>
			<?php echo $this->Html->link($accountItem['Account']['id'], array('controller' => 'accounts', 'action' => 'view', $accountItem['Account']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transaction Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($accountItem['TransactionItem']['transaction_type'], array('controller' => 'transaction_items', 'action' => 'view', $accountItem['TransactionItem']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($accountItem['AccountItem']['amount']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Account Item'), array('action' => 'edit', $accountItem['AccountItem']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Account Item'), array('action' => 'delete', $accountItem['AccountItem']['id']), null, __('Are you sure you want to delete # %s?', $accountItem['AccountItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Account Items'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account Item'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Transaction Items'), array('controller' => 'transaction_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction Item'), array('controller' => 'transaction_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
