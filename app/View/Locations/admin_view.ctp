<div class="locations view">
<h2><?php  echo __('Location');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($location['Location']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client'); ?></dt>
		<dd>
			<?php echo $this->Html->link($location['Client']['name'], array('controller' => 'clients', 'action' => 'view', $location['Client']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Alias'); ?></dt>
		<dd>
			<?php echo h($location['Location']['alias']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address1'); ?></dt>
		<dd>
			<?php echo h($location['Location']['address1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address2'); ?></dt>
		<dd>
			<?php echo h($location['Location']['address2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($location['Location']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($location['Location']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip'); ?></dt>
		<dd>
			<?php echo h($location['Location']['zip']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Location'), array('action' => 'edit', $location['Location']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Location'), array('action' => 'delete', $location['Location']['id']), null, __('Are you sure you want to delete # %s?', $location['Location']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rentals'), array('controller' => 'rentals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rental'), array('controller' => 'rentals', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Rentals');?></h3>
	<?php if (!empty($location['Rental'])):?>
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
		foreach ($location['Rental'] as $rental): ?>
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
