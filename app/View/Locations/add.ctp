<div class="locations form">
	<?php echo $this->Form->create('Location', array('class' => 'form-horizontal'));?>
		<?php
			echo $this->Form->hidden('client_id', array('value' => $client_id));
			echo $this->Form->input('alias');
			echo $this->Form->input('address1');
			echo $this->Form->input('address2');
			echo $this->Form->input('city');
			echo $this->Form->input('state');
			echo $this->Form->input('zip');
		?>
		<?php $this->Matisse->submitButton('Save Location'); ?>
	<?php echo $this->Form->end();?>
</div>
