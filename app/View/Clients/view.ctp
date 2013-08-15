<div class="clients view span7">
	<h3 class="red"><?php echo $client['Client']['name'];?></h3>
	<ul class="profile">
		<li>Account Type: <?php echo ucfirst($client['Client']['type']); ?></li>
		<li>Address: <?php echo $client['Client']['address1']; ?></li>
		<li>Suite/Apt: <?php echo $client['Client']['address2']; ?></li>
		<li>City: <?php echo $client['Client']['city']; ?></li>
		<li>State: <?php echo $client['Client']['state']; ?></li>
		<li>Zip: <?php echo $client['Client']['zip']; ?></li>
		<li>Phone: <?php echo $client['Client']['tel']; ?></li>
	</ul>
	<?php echo $this->Html->link('Edit Profile', array('action' => 'edit', $client['Client']['id']), array('class' => 'btn btn-danger link_matisse')); ?>
</div>
<div class="client locations span7">
	<h3><?php echo __('Client Locations');?></h3>
	<?php if (!empty($client['Location'])):?>
	<?php $i = 0; foreach ($client['Location'] as $location): ?>
		<div class="span7 shadow location_info">
			<ul class="span4">
				<li><h3><?php echo $location['alias'];?></h3></li>
				<li><span class="span1 location_label">Address</span><?php echo $location['address1'];?></li>
				<li><span class="span1 location_label">Suite</span><?php echo $location['address2'];?></li>
				<li><span class="span1 location_label">City</span><?php echo $location['city'];?></li>
				<li><span class="span1 location_label">State</span><?php echo $location['state'];?></li>
				<li><span class="span1 location_label">Zip</span><?php echo $location['zip'];?></li>
			</ul>
			<div class="span3 location button_list">
				<?php echo $this->Html->link($this->Matisse->addIcon('picture') . 'New Rental Here', $this->Matisse->wpLink('gallery/'), array('class' => 'btn btn-danger span2', 'escape' => false));?>
				<?php echo $this->Html->link($this->Matisse->addIcon('pencil') . 'Edit Location', array('controller' => 'locations', 'action' => 'edit', $location['id'] . "~" . $client['Client']['id']), array('class' => 'btn btn-danger link_matisse span2', 'escape' => false)); ?>
				<?php if($i !== 0): ?>
					<?php echo $this->Html->link($this->Matisse->addIcon('remove') . 'Remove Location', array('controller' => 'locations', 'action' => 'delete', $location['id'] . "~" . $client['Client']['id']), array('class' => 'btn btn-danger link_matisse span2', 'escape' => false)); ?>
				<?php endif; ?>
			</div>
			<div class="span6 locations rentals">
				<?php if(!empty($location['Rental'])): ?>
					<h4 class="red">Rentals</h4>
					<?php foreach($location['Rental'] as $rental): ?>
						<p><?php echo $this->Html->link($rental['Artwork']['title'], $this->Matisse->wpHashLink('view-artwork', $rental['Artwork']['id'])) . ' until ' . date('M jS, Y', strtotime(substr($rental['end_date'], 0, 10))) . '.' ?></p>
					<?php endforeach ?>
				<?php endif ?>
			</div>
		</div>
	<?php $i++; endforeach; ?>
	<?php endif; ?>
	<div class="shadow span7 location action_list">
		<ul>
			<li><?php echo $this->Html->link(__('Add New Location'), array('controller' => 'locations', 'action' => 'add', $client['Client']['id']), array('class' => 'btn btn-danger link_matisse'));?></li>
		</ul>
	</div>
</div>
