<div class="images view">
<h2><?php  echo __('Image');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($image['Image']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Artwork'); ?></dt>
		<dd>
			<?php echo $this->Html->link($image['Artwork']['title'], array('controller' => 'artworks', 'action' => 'view', $image['Artwork']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Path'); ?></dt>
		<dd>
			<?php echo h($image['Image']['path']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Featured'); ?></dt>
		<dd>
			<?php echo h($image['Image']['featured']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filetype'); ?></dt>
		<dd>
			<?php echo h($image['Image']['filetype']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filesize'); ?></dt>
		<dd>
			<?php echo h($image['Image']['filesize']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($image['Image']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($image['Image']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Image'), array('action' => 'edit', $image['Image']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Image'), array('action' => 'delete', $image['Image']['id']), null, __('Are you sure you want to delete # %s?', $image['Image']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Images'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Artworks'), array('controller' => 'artworks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Artwork'), array('controller' => 'artworks', 'action' => 'add')); ?> </li>
	</ul>
</div>
