<div class="images index">
	<h2><?php echo __('Images');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('artwork_id');?></th>
			<th><?php echo $this->Paginator->sort('path');?></th>
			<th><?php echo $this->Paginator->sort('featured');?></th>
			<th><?php echo $this->Paginator->sort('filetype');?></th>
			<th><?php echo $this->Paginator->sort('filesize');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($images as $image): ?>
	<tr>
		<td><?php echo h($image['Image']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($image['Artwork']['title'], array('controller' => 'artworks', 'action' => 'view', $image['Artwork']['id'])); ?>
		</td>
		<td><?php echo h($image['Image']['path']); ?>&nbsp;</td>
		<td><?php echo h($image['Image']['featured']); ?>&nbsp;</td>
		<td><?php echo h($image['Image']['filetype']); ?>&nbsp;</td>
		<td><?php echo h($image['Image']['filesize']); ?>&nbsp;</td>
		<td><?php echo h($image['Image']['created']); ?>&nbsp;</td>
		<td><?php echo h($image['Image']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $image['Image']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $image['Image']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $image['Image']['id']), null, __('Are you sure you want to delete # %s?', $image['Image']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Image'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Artworks'), array('controller' => 'artworks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Artwork'), array('controller' => 'artworks', 'action' => 'add')); ?> </li>
	</ul>
</div>
