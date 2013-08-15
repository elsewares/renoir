<div class="clients index">
	<div class="span4">
	<?php if($client): ?>
		<ul>
			<?php if($client['Client']['name'] == ''): ?>
				<li><?php echo $this->Html->link($this->Matisse->addIcon('pencil') . 'Finish My Client Profile', 'edit/0', array('class' => 'btn btn-danger link_matisse span3', 'escape' => false)); ?></li>
			<?php else: ?>
				<li><?php echo $this->Html->link($this->Matisse->addIcon('eye-open') . 'View My Client Profile', 'view/0', array('class' => 'btn btn-danger link_matisse span3', 'escape' => false)); ?></li>
			<?php endif; ?>
				<li><?php echo $this->Html->link($this->Matisse->addIcon('eye-open') . 'View My User Account', array('controller' => 'users', 'action' => 'view', 0), array('class' => 'btn btn-danger link_matisse span3', 'escape' => false)); ?></li>
			<?php if ($client['Client']['name'] !== ''): ?>
				<li><?php echo $this->Html->link($this->Matisse->addIcon('home') . 'Add New Location', array('controller' => 'locations', 'action' => 'add', 0), array('class' => 'btn btn-danger link_matisse span3', 'escape' => false)); ?></li>
			<?php endif; ?>
		</ul>
	<?php else: ?>
		<ul>
			<li><?php echo $this->Html->link($this->Matisse->addIcon('plus-sign') . 'Create Client Account', $this->Matisse->wpLink('client-registration'), array('class' => 'btn btn-danger span3', 'escape' => false)); ?></li>
		</ul>
	<?php endif; ?>
	</div>
</div>
