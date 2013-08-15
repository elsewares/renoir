<div class="accountItems form">
<?php echo $this->Form->create('AccountItem');?>
	<fieldset>
		<legend><?php echo __('Edit Account Item'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('account_id');
		echo $this->Form->input('transaction_item_id');
		echo $this->Form->input('amount');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('AccountItem.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('AccountItem.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Account Items'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Accounts'), array('controller' => 'accounts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account'), array('controller' => 'accounts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Transaction Items'), array('controller' => 'transaction_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Transaction Item'), array('controller' => 'transaction_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
