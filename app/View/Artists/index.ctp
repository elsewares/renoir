<div class="artists index row">
	<div class="span6 artist_list">
		<ul>
			<?php foreach($list as $name => $id): ?>
			<li><?php echo $this->Html->link($name, array('controller' => 'artists', 'action' => 'view', $id), array('class' => 'artist_index_link link_matisse')); ?></li>
			<?php endforeach; ?>
		</ul>

	</div>
	<?php if($artist): ?>
		<ul class="span4">
			<?php if($artist['Artist']['name'] == ''): ?>
				<li><?php echo $this->Html->link($this->Matisse->addIcon('pencil') . 'Finish My Artist Profile', 'edit/', array('class' => 'btn btn-danger link_matisse span3', 'escape' => false)); ?></li>
			<?php else: ?>
				<li><?php echo $this->Html->link($this->Matisse->addIcon('eye-open') . 'View My Artist Profile', 'edit/', array('class' => 'btn btn-danger link_matisse span3', 'escape' => false)); ?></li>
			<?php endif; ?>
				<li><?php echo $this->Html->link($this->Matisse->addIcon('eye-open') . 'View My User Account', array('controller' => 'users', 'action' => 'view'), array('class' => 'btn btn-danger link_matisse span3', 'escape' => false)); ?></li>
			<?php if ($artist['Artist']['name'] !== ''): ?>
				<li><?php echo $this->Html->link($this->Matisse->addIcon('picture') . 'Submit Additional Artwork', array('controller' => 'artworks', 'action' => 'submission'), array('class' => 'btn btn-danger link_matisse span3', 'escape' => false)); ?></li>
			<?php endif; ?>
		</ul>
	<?php endif; ?>
</div>