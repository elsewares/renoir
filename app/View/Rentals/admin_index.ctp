<div class="rentals index">
	<h2><?php echo __('Rentals');?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-condensed table-hover">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('artwork_id');?></th>
			<th><?php echo $this->Paginator->sort('client_id');?></th>
			<th><?php echo $this->Paginator->sort('location_id');?></th>
			<th><?php echo $this->Paginator->sort('order_id');?></th>
			<th><?php echo $this->Paginator->sort('start_date');?></th>
			<th><?php echo $this->Paginator->sort('end_date');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($rentals as $rental): ?>
	<tr>
		<td><?php echo h($rental['Rental']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($rental['Artwork']['title'], array('controller' => 'artworks', 'action' => 'view', $rental['Artwork']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($rental['Client']['name'], array('controller' => 'clients', 'action' => 'view', $rental['Client']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($rental['Location']['alias'], array('controller' => 'locations', 'action' => 'view', $rental['Location']['id'])); ?>
		</td>
		<td><?php echo h($rental['Rental']['order_id']); ?>&nbsp;</td>
		<td><?php echo h($rental['Rental']['start_date']); ?>&nbsp;</td>
		<td><?php echo h($rental['Rental']['end_date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $rental['Rental']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $rental['Rental']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $rental['Rental']['id']), null, __('Are you sure you want to delete # %s?', $rental['Rental']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Artworks'), array('controller' => 'artworks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
	</ul>
</div>
