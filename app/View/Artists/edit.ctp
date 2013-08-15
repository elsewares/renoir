<div class="artists form edit_form">
	<?php echo $this->Form->create('Artist', array('class' => 'form-horizontal'));?>
		<fieldset>
		<?php
			echo $this->Form->hidden('id', array('value' => $artist['Artist']['id']));
			echo $this->Form->input('name', array('value' => $artist['Artist']['name']));
			echo $this->Form->input('email', array('value' => $artist['User']['username'], 'disabled' => 'disabled'));
			echo $this->Form->input('tel', array('value' => $artist['Artist']['tel']));
			echo $this->Form->input('address', array('value' => $artist['Artist']['address']));
			echo $this->Form->input('address2', array('value' => $artist['Artist']['address2']));
			echo $this->Form->input('city', array('value' => $artist['Artist']['city']));
			echo $this->Form->input('state', array('value' => $artist['Artist']['state']));
			echo $this->Form->input('zip', array('value' => $artist['Artist']['zip']));
			echo $this->Form->input('neighborhood', array('value' => $artist['Artist']['neighborhood']));
			echo $this->Form->input('url', array('value' => 'http://' . $artist['Artist']['url']));
			echo $this->Form->input('medium', array('value' => $artist['Artist']['medium']));
			echo $this->Form->input('bio', array('value' => $artist['Artist']['bio']));
		?>
			<?php $this->Matisse->submitButton('Save'); ?>
		</fieldset>
	<?php echo $this->Form->end();?>
</div>
