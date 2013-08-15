<div class="rentals form">
<?php echo $this->Form->create('Rental');?>
	<fieldset>
		<legend><?php echo __('Admin Add Rental'); ?></legend>
		<p><?php echo "Artwork: " . $artworks['Artwork']['title']; ?></p>	
		<p><?php echo "Client: " . $client_name; ?></p>	
	<?php
		echo $this->Form->hidden('client_id', array('value' => $client_id));
		echo $this->Form->hidden('artwork_id', array('value' => $artworks['Artwork']['id']));
	?>
	<?php if(isset($locations) && !empty($locations)): ?>
		<?php echo $this->Form->input('location_id', array($locations)); ?>
	<?php else: ?>
		<p>Client not registered with the site - admin add.</p>
	<?php endif; ?>
		<p><?php echo "Order ID: " . $order_id ?></p>
	<?php
		echo $this->Form->hidden('order_id', array('value' => $order_id));
		echo $this->Form->input('start_date', array('timeFormat' => null, 'dateFormat' => 'DMY', 'class' => 'span1'));
		echo $this->Form->input('end_date', array('timeFormat' => null, 'dateFormat' => 'DMY', 'class' => 'span1'));
		echo $this->Matisse->submitButton('Add Rental', array('btn-danger span2')); ?>
	</fieldset>
<?php echo $this->Form->end();?>
</div>
