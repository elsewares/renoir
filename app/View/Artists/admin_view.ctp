<div class="artists view">
<h2><?php  echo __('Artist');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($artist['Artist']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($artist['Artist']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tel'); ?></dt>
		<dd>
			<?php echo h($artist['Artist']['tel']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($artist['Artist']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address2'); ?></dt>
		<dd>
			<?php echo h($artist['Artist']['address2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($artist['Artist']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($artist['Artist']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip'); ?></dt>
		<dd>
			<?php echo h($artist['Artist']['zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Neighborhood'); ?></dt>
		<dd>
			<?php echo h($artist['Artist']['neighborhood']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($artist['Artist']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Medium'); ?></dt>
		<dd>
			<?php echo h($artist['Artist']['medium']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bio'); ?></dt>
		<dd>
			<?php echo h($artist['Artist']['bio']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Confirmation'); ?></dt>
		<dd>
			<?php echo h($artist['Artist']['confirmation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($artist['Artist']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($artist['Artist']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($artist['Artist']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($artist['User']['id'], array('controller' => 'users', 'action' => 'view', $artist['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Artist'), array('action' => 'edit', $artist['Artist']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Artist'), array('action' => 'delete', $artist['Artist']['id']), null, __('Are you sure you want to delete # %s?', $artist['Artist']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Artists'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Artist'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Artworks'), array('controller' => 'artworks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Artwork'), array('controller' => 'artworks', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Artworks');?></h3>
	<?php if (!empty($artist['Artwork'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Artist Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Dimensions'); ?></th>
		<th><?php echo __('Pieces'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Custom'); ?></th>
		<th><?php echo __('Prints'); ?></th>
		<th><?php echo __('Print Price'); ?></th>
		<th><?php echo __('Is Submission'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($artist['Artwork'] as $artwork): ?>
		<tr>
			<td><?php echo $artwork['id'];?></td>
			<td><?php echo $artwork['artist_id'];?></td>
			<td><?php echo $artwork['title'];?></td>
			<td><?php echo $artwork['description'];?></td>
			<td><?php echo $artwork['dimensions'];?></td>
			<td><?php echo $artwork['pieces'];?></td>
			<td><?php echo $artwork['price'];?></td>
			<td><?php echo $artwork['custom'];?></td>
			<td><?php echo $artwork['prints'];?></td>
			<td><?php echo $artwork['print_price'];?></td>
			<td><?php echo $artwork['is_submission'];?></td>
			<td><?php echo $artwork['active'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'artworks', 'action' => 'view', $artwork['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'artworks', 'action' => 'edit', $artwork['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'artworks', 'action' => 'delete', $artwork['id']), null, __('Are you sure you want to delete # %s?', $artwork['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Artwork'), array('controller' => 'artworks', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
