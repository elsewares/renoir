<div class="artists index">
	<h2><?php echo __('Artists');?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-condensed table-hover">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('tel');?></th>
			<th><?php echo $this->Paginator->sort('address');?></th>
			<th><?php echo $this->Paginator->sort('address2');?></th>
			<th><?php echo $this->Paginator->sort('city');?></th>
			<th><?php echo $this->Paginator->sort('state');?></th>
			<th><?php echo $this->Paginator->sort('zip');?></th>
			<th><?php echo $this->Paginator->sort('neighborhood');?></th>
			<th><?php echo $this->Paginator->sort('url');?></th>
			<th><?php echo $this->Paginator->sort('medium');?></th>
			<th><?php echo $this->Paginator->sort('bio');?></th>
			<th><?php echo $this->Paginator->sort('confirmation');?></th>
			<th><?php echo $this->Paginator->sort('active');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($artists as $artist): ?>
	<tr>
		<td><?php echo h($artist['Artist']['id']); ?>&nbsp;</td>
		<td><?php echo h($artist['Artist']['name']); ?>&nbsp;</td>
		<td><?php echo h($artist['Artist']['tel']); ?>&nbsp;</td>
		<td><?php echo h($artist['Artist']['address']); ?>&nbsp;</td>
		<td><?php echo h($artist['Artist']['address2']); ?>&nbsp;</td>
		<td><?php echo h($artist['Artist']['city']); ?>&nbsp;</td>
		<td><?php echo h($artist['Artist']['state']); ?>&nbsp;</td>
		<td><?php echo h($artist['Artist']['zip']); ?>&nbsp;</td>
		<td><?php echo h($artist['Artist']['neighborhood']); ?>&nbsp;</td>
		<td><?php echo h($artist['Artist']['url']); ?>&nbsp;</td>
		<td><?php echo h($artist['Artist']['medium']); ?>&nbsp;</td>
		<td>Edit to see bio.</td>
		<td><?php echo h($artist['Artist']['confirmation']); ?>&nbsp;</td>
		<td><?php echo h($artist['Artist']['active']); ?>&nbsp;</td>
		<td><?php echo h($artist['Artist']['created']); ?>&nbsp;</td>
		<td><?php echo h($artist['Artist']['modified']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($artist['User']['id'], array('controller' => 'users', 'action' => 'view', $artist['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $artist['Artist']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $artist['Artist']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $artist['Artist']['id']), null, __('Are you sure you want to delete # %s?', $artist['Artist']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Artist'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Artworks'), array('controller' => 'artworks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Artwork'), array('controller' => 'artworks', 'action' => 'add')); ?> </li>
	</ul>
</div>
