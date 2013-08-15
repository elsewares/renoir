<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<!--<legend><?php echo __('Register for HangItUp Chicago'); ?></legend>-->
	<?php
        echo $this->Form->input('username', array('label' => 'Email'));
		echo $this->Form->input('password', array('label' => 'Choose a Password', 'placeholder' => 'password', 'id' => "password_1"));
        echo $this->Form->input('password', array('placeholder' => 'once more with feeling ...', 'required' => true, 'id' => "password_2"));
		echo $this->Form->hidden('role', array('value' => $role));
		echo $this->Form->hidden('active', array('value' => false));
		$this->Matisse->submitButton('Register', array('btn-danger check_pass_first'));	
	?>
	</fieldset>
<?php echo $this->Form->end(); ?>
</div>
