<div class="artworks view">
<h2><?php  echo __('Artwork');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($artwork['Artwork']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Artist'); ?></dt>
		<dd>
			<?php echo $this->Html->link($artwork['Artist']['name'], array('controller' => 'artists', 'action' => 'view', $artwork['Artist']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($artwork['Artwork']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($artwork['Artwork']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dimensions'); ?></dt>
		<dd>
			<?php echo h($artwork['Artwork']['dimensions']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pieces'); ?></dt>
		<dd>
			<?php echo h($artwork['Artwork']['pieces']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($artwork['Artwork']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Custom'); ?></dt>
		<dd>
			<?php echo h($artwork['Artwork']['custom']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prints'); ?></dt>
		<dd>
			<?php echo h($artwork['Artwork']['prints']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Print Price'); ?></dt>
		<dd>
			<?php echo h($artwork['Artwork']['print_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Submission'); ?></dt>
		<dd>
			<?php echo h($artwork['Artwork']['is_submission']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($artwork['Artwork']['active']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Artwork'), array('action' => 'edit', $artwork['Artwork']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Artwork'), array('action' => 'delete', $artwork['Artwork']['id']), null, __('Are you sure you want to delete # %s?', $artwork['Artwork']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Artworks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Artwork'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Images');?></h3>
	<?php if (!empty($artwork['Image'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Artwork Id'); ?></th>
		<th><?php echo __('Uri'); ?></th>
		<th><?php echo __('Uri Span3'); ?></th>
		<th><?php echo __('Featured'); ?></th>
		<th><?php echo __('Filetype'); ?></th>
		<th><?php echo __('Filesize'); ?></th>
		<th><?php echo __('Height'); ?></th>
		<th><?php echo __('Width'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($artwork['Image'] as $image): ?>
		<tr>
			<td><?php echo $image['id'];?></td>
			<td><?php echo $image['artwork_id'];?></td>
			<td><?php echo $image['uri'];?></td>
			<td><?php echo $image['uri_span3'];?></td>
			<td><?php echo $image['featured'];?></td>
			<td><?php echo $image['filetype'];?></td>
			<td><?php echo $image['filesize'];?></td>
			<td><?php echo $image['height'];?></td>
			<td><?php echo $image['width'];?></td>
			<td><?php echo $image['created'];?></td>
			<td><?php echo $image['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'images', 'action' => 'view', $image['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'images', 'action' => 'edit', $image['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'images', 'action' => 'delete', $image['id']), null, __('Are you sure you want to delete # %s?', $image['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Image'), array('controller' => 'images', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Rentals');?></h3>
	<?php if (!empty($artwork['Rental'])):?>
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
		foreach ($artwork['Rental'] as $rental): ?>
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
<div class="related">
	<h3><?php echo __('Related Order Items');?></h3>
	<?php if (!empty($artwork['OrderItems'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Order Id'); ?></th>
		<th><?php echo __('Artwork Id'); ?></th>
		<th><?php echo __('Item Type'); ?></th>
		<th><?php echo __('Amount'); ?></th>
		<th><?php echo __('Charges'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($artwork['OrderItems'] as $orderItems): ?>
		<tr>
			<td><?php echo $orderItems['id'];?></td>
			<td><?php echo $orderItems['order_id'];?></td>
			<td><?php echo $orderItems['artwork_id'];?></td>
			<td><?php echo $orderItems['item_type'];?></td>
			<td><?php echo $orderItems['amount'];?></td>
			<td><?php echo $orderItems['charges'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'order_items', 'action' => 'view', $orderItems['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'order_items', 'action' => 'edit', $orderItems['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'order_items', 'action' => 'delete', $orderItems['id']), null, __('Are you sure you want to delete # %s?', $orderItems['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Order Items'), array('controller' => 'order_items', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
