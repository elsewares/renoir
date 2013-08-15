<?php $role = $user['role']; ?>
<div class="users view">
	<h3 class="subheader"><?php  echo __('Hello ' . $user['username']);?></h3>
	<ul>
		<li>Account Type: <?php echo $this->Html->link(ucfirst($role), array('controller' => Inflector::pluralize($role), 'action' => 'view', 0), array('class' => 'link_matisse')); ?></li>
		<li>Joined: <?php echo h($user['created']); ?></li>
		<li>
			<form class="password_reset_matisse form-horizontal">
				<fieldset>
					<legend>Reset Password</legend>
					<?php echo $this->Form->input('password', array('id' => 'newpass_1', 'class' => 'password_verify')); ?>
					<?php echo $this->Form->input('password', array('id' => 'newpass_2', 'class' => 'password_verify')); ?>
					<?php echo $this->Form->button('Change Password', array('class' => 'btn change_pass')); ?>
				</fieldset>
			</form>
		</li>
	</ul>
</div>