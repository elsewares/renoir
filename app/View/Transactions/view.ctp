<div class="transactions view">
<h2><?php  echo __('Transaction');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Uuid'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['uuid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Approval'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['approval']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order'); ?></dt>
		<dd>
			<?php echo $this->Html->link($transaction['Order']['order_id'], array('controller' => 'orders', 'action' => 'view', $transaction['Order']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client'); ?></dt>
		<dd>
			<?php echo $this->Html->link($transaction['Client']['name'], array('controller' => 'clients', 'action' => 'view', $transaction['Client']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Settled'); ?></dt>
		<dd>
			<?php echo h($transaction['Transaction']['settled']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Transaction'), array('action' => 'edit', $transaction['Transaction']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Transaction'), array('action' => 'delete', $transaction['Transaction']['id']), null, __('Are you sure you want to delete # %s?', $transaction['Transaction']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Transactions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
	</ul>
</div>
