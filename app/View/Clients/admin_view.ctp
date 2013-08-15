<div class="clients view">
<h2><?php  echo __('Client');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($client['Client']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($client['User']['id'], array('controller' => 'users', 'action' => 'view', $client['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($client['Client']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($client['Client']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address1'); ?></dt>
		<dd>
			<?php echo h($client['Client']['address1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address2'); ?></dt>
		<dd>
			<?php echo h($client['Client']['address2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($client['Client']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($client['Client']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip'); ?></dt>
		<dd>
			<?php echo h($client['Client']['zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tel'); ?></dt>
		<dd>
			<?php echo h($client['Client']['tel']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($client['Client']['active']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Client'), array('action' => 'edit', $client['Client']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Client'), array('action' => 'delete', $client['Client']['id']), null, __('Are you sure you want to delete # %s?', $client['Client']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rentals'), array('controller' => 'rentals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rental'), array('controller' => 'rentals', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Locations');?></h3>
	<?php if (!empty($client['Location'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Client Id'); ?></th>
		<th><?php echo __('Alias'); ?></th>
		<th><?php echo __('Address1'); ?></th>
		<th><?php echo __('Address2'); ?></th>
		<th><?php echo __('City'); ?></th>
		<th><?php echo __('State'); ?></th>
		<th><?php echo __('Zip'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($client['Location'] as $location): ?>
		<tr>
			<td><?php echo $location['id'];?></td>
			<td><?php echo $location['client_id'];?></td>
			<td><?php echo $location['alias'];?></td>
			<td><?php echo $location['address1'];?></td>
			<td><?php echo $location['address2'];?></td>
			<td><?php echo $location['city'];?></td>
			<td><?php echo $location['state'];?></td>
			<td><?php echo $location['zip'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'locations', 'action' => 'view', $location['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'locations', 'action' => 'edit', $location['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'locations', 'action' => 'delete', $location['id']), null, __('Are you sure you want to delete # %s?', $location['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Rentals');?></h3>
	<?php if (!empty($client['Rental'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Artwork Id'); ?></th>
		<th><?php echo __('Client Id'); ?></th>
		<th><?php echo __('Location Id'); ?></th>
		<th><?php echo __('Transaction Item Id'); ?></th>
		<th><?php echo __('Start Date'); ?></th>
		<th><?php echo __('End Date'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($client['Rental'] as $rental): ?>
		<tr>
			<td><?php echo $rental['id'];?></td>
			<td><?php echo $rental['artwork_id'];?></td>
			<td><?php echo $rental['client_id'];?></td>
			<td><?php echo $rental['location_id'];?></td>
			<td><?php echo $rental['transaction_item_id'];?></td>
			<td><?php echo $rental['start_date'];?></td>
			<td><?php echo $rental['end_date'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'rentals', 'action' => 'view', $rental['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'rentals', 'action' => 'edit', $rental['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'rentals', 'action' => 'delete', $rental['id']), null, __('Are you sure you want to delete # %s?', $rental['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Rental'), array('controller' => 'rentals', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
