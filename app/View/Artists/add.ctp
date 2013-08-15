<div class="artists form">
	<?php echo $this->Form->create('Artist', array('class' => 'form-horizontal'));?>
		<fieldset>
			<legend><?php echo __('Complete your artist profile.'); ?></legend>
		<?php
			echo $this->Form->hidden('id', array('value' => $artist['Artist']['id']));
			echo $this->Form->hidden('user_id', array('value' => $artist['Artist']['user_id']));
			echo $this->Form->input('name', array('required' => 'true'));
			echo $this->Form->input('tel', array('placeholder' => '555-867-5309', 'required' => 'true'));
			echo $this->Form->input('address', array('required' => 'true'));
			echo $this->Form->input('address2');
			echo $this->Form->input('city', array('required' => 'true'));
			echo $this->Form->input('state', array('required' => 'true'));
			echo $this->Form->input('zip', array('type' => 'text', 'required' => 'true'));
			echo $this->Form->input('neighborhood', array('placeholder' => 'Wicker Park', 'required' => 'true'));
			echo $this->Form->input('url', array('placeholder' => 'http://', 'value' => 'http://'));
			echo $this->Form->input('medium', array('placeholder' => 'i.e. oil, mixed media, stone'));
			echo $this->Form->input('bio', array('placeholder' => 'A short intro to you as an artist, and your philosophy.', 'cols' => '30'));
		?>
		<?php echo $this->element('terms_paragraph'); ?>
		<?php echo $this->element('Artists/contract'); ?>
		<?php
			echo $this->Form->input('confirmation', array('type' => 'checkbox', 'label' => 'Consignment', 'value' => true, 'required' => true));
			echo $this->Form->input('confirmation', array('type' => 'checkbox', 'label' => 'Terms of Service', 'value' => true, 'required' => true));
		?>
		</fieldset>
		<?php $this->Matisse->submitButton('Save Artist Profile'); ?>
		<?php $this->Form->end(); ?>
</div>