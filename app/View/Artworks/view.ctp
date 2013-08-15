<?php $portrait = ($artwork['Image']['0']['height'] > $artwork['Image'][0]['width'])? true : false; ?>
<div class="view_container">
	<div class="artworks view">
		<div class="row">
			<hgroup class="span7">
				<h1 class="artwork_title red"><?php echo $artwork['Artwork']['title'] ?></h1>
				<h2 class="dk-slate artwork_artist"><?php echo $artwork['Artist']['name'] ?></h2>
			</hgroup>
			<div class="span5 view_actions">
				<ul>
					<li><?php echo $this->Html->link($this->Matisse->addIcon('remove-circle', true) . 'Back to Gallery', $this->Matisse->wpLink('gallery'), array('class' => 'btn btn-danger view_escape span3', 'escape' => false)); ?></li>
					<li><?php echo $this->Html->link($this->Matisse->addIcon('eye-open', true) . 'More by This Artist', $this->Matisse->wpLink('artist-profile/#matisse:' . $artwork['Artist']['id']), array('class' => 'btn btn-danger view_escape span3', 'escape' => false)); ?></li>
				</ul>
			</div>
		</div>
		<?php if($portrait): ?>
		<div class="row dk-slate">
			<div class="span5 artwork_frame">
				<?php if(isset($artwork['Artwork']['is_rented']) && $artwork['Artwork']['is_rented']): ?>
					<?php echo $this->Html->image('rented_sash.png', array('class' => 'rented_sash sash')); ?>
				<?php endif ?>
				<?php if(isset($artwork['Artwork']['is_purchased']) && $artwork['Artwork']['is_purchased']): ?>
					<?php echo $this->Html->image('purchased_sash.png', array('class' => 'rented_sash sash')); ?>
				<?php endif ?>
				<?php if(isset($artwork['Artwork']['is_rented']) || isset($artwork['Artwork']['is_rented'])): ?>
					<img src="<?php echo $this->Html->url($artwork['Image'][0]['uri'], true) ?>" class="span4" width="320" style="margin-top: -120px;"/>
				<?php else: ?>
					<img src="<?php echo $this->Html->url($artwork['Image'][0]['uri'], true) ?>" class="span4" width="320"/>
				<?php endif ?>
			</div>
			<div class="span7 artwork_info">
				<div class="row">
					<p class="span2">Description</p>
					<p class="span5"><?php echo $artwork['Artwork']['description']; ?></p>
				</div>
				<div class="row">
					<p class="span2">Dimensions</p>
					<ul class="span5">
						<?php echo $this->Matisse->displayDimensions($artwork['Artwork']['dimensions']) ?>
					</ul>
				</div>
				<div class="row">
					<p class="span2">Purchase Price</p>
					<p class="span5"><?php echo "$ " . $artwork['Artwork']['price'] ?></p>
				</div>
				<?php if ($artwork['Artwork']['prints']): ?>
					<div class="row">
						<p class="span2">Prints Available</p>
						<p class="span5"><?php echo '$ ' . $artwork['Artwork']['print_price'] ?></p>
					</div>
				<?php endif; ?>
				<?php if ($artwork['Artwork']['custom']): ?>
					<div class="row">
						<p class="span3">Custom Sizing Available</p>
					</div>
				<?php endif; ?>
				<?php echo $this->element('Artworks/purchase_buttons'); ?>
			</div>
		</div>
		<?php else: ?>
		<div class="row">
			<div class="span7 artwork_frame">
				<?php if(isset($artwork['Artwork']['is_rented']) && $artwork['Artwork']['is_rented']): ?>
					<?php echo $this->Html->image('rented_sash.png', array('class' => 'rented_sash sash')); ?>
				<?php endif ?>
				<?php if(isset($artwork['Artwork']['is_purchased']) && $artwork['Artwork']['is_purchased']): ?>
					<?php echo $this->Html->image('purchased_sash.png', array('class' => 'rented_sash sash')); ?>
				<?php endif ?>
				<?php if(isset($artwork['Artwork']['is_rented']) || isset($artwork['Artwork']['is_purchased'])): ?>
					<img src="<?php echo $this->Html->url($artwork['Image'][0]['uri'], true) ?>" class="span6" width="480" style="margin-top: -120px;"/>
				<?php else: ?>
					<img src="<?php echo $this->Html->url($artwork['Image'][0]['uri'], true) ?>" class="span6" width="480"/>
				<?php endif ?>
			</div>
			<div class="span5 artwork_info">
				<div class="row">
					<p class="span2">Description</p>
					<p class="span3"><?php echo $artwork['Artwork']['description']; ?></p>
				</div>
				<div class="row">
					<p class="span2">Dimensions</p>
					<ul class="span5">
						<?php echo $this->Matisse->displayDimensions($artwork['Artwork']['dimensions']); ?>
					</ul>
				</div>
				<div class="row">
					<p class="span2">Purchase Price</p>
					<p class="span3"><?php echo "$ " . $artwork['Artwork']['price'] ?></p>
				</div>
				<?php if ($artwork['Artwork']['prints']): ?>
					<div class="row">
						<p class="span2">Prints Available</p>
						<p class="span3"><?php echo '$ ' . $artwork['Artwork']['print_price'] ?></p>
					</div>
				<?php endif; ?>
				<?php if ($artwork['Artwork']['custom']): ?>
					<div class="row">
						<p class="span3">Custom Sizing Available</p>
					</div>
				<?php endif; ?>
				<?php echo $this->element('Artworks/purchase_buttons'); ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>