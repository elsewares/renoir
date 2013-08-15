<div class="clients form">
	<?php echo $this->Form->create('Client', array('class' => 'form-horizontal'));?>
		<fieldset class="client">
			<?php
				echo $this->Form->hidden('active', array('value' => true));
				echo $this->Form->input('Client.name');
				echo $this->Form->input('Client.type', array('options' => array('Business', 'Personal'), 'default' => 'Personal'));
				echo $this->Form->input('Client.address1', array('class' => 'addr1'));
				echo $this->Form->input('Client.address2', array('class' => 'addr2'));
				echo $this->Form->input('Client.city', array('class' => 'city'));
				echo $this->Form->input('Client.state', array('class' => 'state'));
				echo $this->Form->input('Client.zip', array('class' => 'zip'));
				echo $this->Form->input('Client.tel', array('placeholder' => '555-555-1212'));
				echo $this->Form->input('Client.email', array('value' => $user['username'], 'disabled' => true));
			?>
			<?php echo $this->element('terms_paragraph'); ?>
			<?php echo $this->element('Clients/contract'); ?>
			
			<?php
				echo $this->Form->input('confirmation', array('type' => 'checkbox', 'label' => 'Rental and Purchase', 'value' => true, 'required' => true));
				echo $this->Form->input('confirmation', array('type' => 'checkbox', 'label' => 'Terms of Service', 'value' => true, 'required' => true));
			?>
		</fieldset>
		<fieldset class="location">
			<legend class="secondary"><?php echo __('Add your default location.'); ?></legend>
			<?php
				echo $this->Form->hidden('Client.client_id');
				echo $this->Form->input('Location.same', array('type' => 'checkbox', 'label' => 'Same as billing address?', 'id' => 'client_location_same'));
				echo $this->Form->input('Location.0.alias', array('label' => 'Name', 'placeholder' => 'My Office', 'class' => 'alias'));
				echo $this->Form->input('Location.0.address1', array('label' => 'Address', 'class' => 'addr1'));
				echo $this->Form->input('Location.0.address2', array('label' => 'Suite/Floor', 'class' => 'addr2'));
				echo $this->Form->input('Location.0.city', array('class' => 'city'));
				echo $this->Form->input('Location.0.state', array('class' => 'state'));
				echo $this->Form->input('Location.0.zip', array('type' => 'text', 'class' => 'zip'));
			?>
		</fieldset>
		<?php $this->Matisse->submitButton('Save Client Profile'); ?>
	<?php echo $this->Form->end();?>
</div>