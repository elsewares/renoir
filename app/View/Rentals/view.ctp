<div class="rentals view">
<h2><?php  echo __('Rental');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($rental['Rental']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Artwork'); ?></dt>
		<dd>
			<?php echo $this->Html->link($rental['Artwork']['title'], array('controller' => 'artworks', 'action' => 'view', $rental['Artwork']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client'); ?></dt>
		<dd>
			<?php echo $this->Html->link($rental['Client']['name'], array('controller' => 'clients', 'action' => 'view', $rental['Client']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo $this->Html->link($rental['Location']['alias'], array('controller' => 'locations', 'action' => 'view', $rental['Location']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transaction Item Id'); ?></dt>
		<dd>
			<?php echo h($rental['Rental']['transaction_item_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Date'); ?></dt>
		<dd>
			<?php echo h($rental['Rental']['start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Date'); ?></dt>
		<dd>
			<?php echo h($rental['Rental']['end_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Rental'), array('action' => 'edit', $rental['Rental']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Rental'), array('action' => 'delete', $rental['Rental']['id']), null, __('Are you sure you want to delete # %s?', $rental['Rental']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rentals'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rental'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Artworks'), array('controller' => 'artworks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Artwork'), array('controller' => 'artworks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('controller' => 'clients', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
	</ul>
</div>
