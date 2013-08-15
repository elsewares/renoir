<div class="accounts form">
<?php echo $this->Form->create('Account');?>
	<fieldset>
		<legend><?php echo __('Admin Add Account'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('uuid');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Accounts'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Account Items'), array('controller' => 'account_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Account Item'), array('controller' => 'account_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
