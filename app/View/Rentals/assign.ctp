<?php if(!empty($order['OrderItem'])): ?>
	<div class="rentals form assign">
	<?php $select_options = array(); ?>
	<?php foreach($order['Client']['Location'] as $location): ?>
	<?php $select_options[$location['id']] = $location['alias']; ?>
	<?php //debug($select_options, true, true); ?>
	<?php endforeach ?>
	<?php $keys = array_keys($select_options); $d_id = $keys[0]; $d_val = $select_options[$keys[0]] ?>
	<?php foreach($order['OrderItem'] as $rental): ?>
		<?php if($rental && $rental['item_type'] == 'rental'): ?>
			<?php echo $this->Form->create('Rental', array('class' => 'shadow-box span6'));?>
			<h4>Location where <span class="red"><?php echo $rental['Artwork']['title'] ?></span> will be installed:</h4>
				<?php
					echo $this->Form->select('location_id', $select_options, array('showParents' => false, 'selected' => $d_id, 'empty' => false, 'value' => $d_id));
					echo $this->Form->hidden('artwork_id', array('value' => $rental['Artwork']['id']));
					echo $this->Form->hidden('client_id', array('value' => $order['Client']['id']));
					echo $this->Form->hidden('order_id', array('value' => $order['Order']['order_id']));
					echo $this->Form->hidden('on_hold', array('value' => true));
				?>
				<?php $this->Matisse->submitButton('Assign Rental', array('partial_matisse')); ?>
			<?php echo $this->Form->end();?>
		<?php endif; ?>
	<?php endforeach; ?>
	<?php echo $this->Html->link('Assign Rentals Later', $this->Matisse->wpLink($user['role'] . '-profile/'), array('class' => 'btn btn-danger link_matisse span3 assign_later')); ?>
	<div class="partials_complete" style="display: none;" rel="<?php echo $user['role'] . '-profile/' ?>"></div>
	</div>
<?php else: ?>
	<p>All rentals from this order have been assigned.</p>
	<?php echo $this->Html->link('Go to My Profile Page', $this->Matisse->wpLink($user['role'] . '-profile/'), array('class' => 'btn btn-danger link_matisse span3 assign_later')); ?>
<?php endif ?>