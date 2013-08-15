<div class="artists form">
<?php echo $this->Form->create('Artist');?>
	<fieldset>
		<legend><?php echo __('Complete your artist profile.'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('tel', array('label' => 'Phone'));
		echo $this->Form->input('address');
		echo $this->Form->input('neighborhood');
		echo $this->Form->input('url', array('label' => 'Website'));
		echo $this->Form->input('medium', array('label' => 'Preferred Medium'));
		echo $this->Form->input('bio', array('label' => 'Brief bio'));
		echo $this->Form->hidden('new_artist', array('value' => 'true'));
	?>
		<span class="terms">By clicking the checkbox below, you are agreeing to the HangItUp Chicago Terms of Service for Artists.</span>
	<?php
		echo $this->Form->input('confirmation', array('label' => 'I agree to the Terms of Service.'));
		$this->MatisseHelper->submitButton('Save Profile');
	?>
	</fieldset>
<?php echo $this->Form->end();?>
</div>