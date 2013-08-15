<div class="artworks index">
	<h2><?php echo __('Artworks');?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-condensed table-hover">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('artist_id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('dimensions');?></th>
			<th><?php echo $this->Paginator->sort('pieces');?></th>
			<th><?php echo $this->Paginator->sort('price');?></th>
			<th><?php echo $this->Paginator->sort('rental_only');?></th>
			<th><?php echo $this->Paginator->sort('custom');?></th>
			<th><?php echo $this->Paginator->sort('prints');?></th>
			<th><?php echo $this->Paginator->sort('print_price');?></th>
			<th><?php echo $this->Paginator->sort('is_submission');?></th>
			<th><?php echo $this->Paginator->sort('active');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($artworks as $artwork): ?>
	<tr>
		<td><?php echo h($artwork['Artwork']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($artwork['Artist']['name'], array('controller' => 'artists', 'action' => 'view', $artwork['Artist']['id'])); ?>
		</td>
		<td><?php echo h($artwork['Artwork']['title']); ?>&nbsp;</td>
		<td><?php echo h($artwork['Artwork']['description']); ?>&nbsp;</td>
		<td><?php echo h($artwork['Artwork']['dimensions']); ?>&nbsp;</td>
		<td><?php echo h($artwork['Artwork']['pieces']); ?>&nbsp;</td>
		<td><?php echo h($artwork['Artwork']['price']); ?>&nbsp;</td>
		<td><?php echo h($artwork['Artwork']['rental_only']); ?>&nbsp;</td>
		<td><?php echo h($artwork['Artwork']['custom']); ?>&nbsp;</td>
		<td><?php echo h($artwork['Artwork']['prints']); ?>&nbsp;</td>
		<td><?php echo h($artwork['Artwork']['print_price']); ?>&nbsp;</td>
		<td><?php echo h($artwork['Artwork']['is_submission']); ?>&nbsp;</td>
		<td><?php echo h($artwork['Artwork']['active']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $artwork['Artwork']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $artwork['Artwork']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $artwork['Artwork']['id']), null, __('Are you sure you want to delete # %s?', $artwork['Artwork']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Artwork'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Artists'), array('controller' => 'artists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Artist'), array('controller' => 'artists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Images'), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image'), array('controller' => 'images', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rentals'), array('controller' => 'rentals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rental'), array('controller' => 'rentals', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('controller' => 'order_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Items'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
