<div class="artists profile">
<h2><?php  echo __('Artist Profile for ' . $artist['Artist']['name']);?></h2>
<div class="profile-fields">
	<div class="row">
		<div class="profile-label span5"><?php echo __('Name'); ?></div>
		<div class="profile-data span10"><?php echo h($artist['Artist']['name']); ?></div>
		<button class="btn mini hover-show">Edit</button>
	</div>
	<div class="row">
		<div class="profile-label span5"><?php echo __('Email'); ?></div>
		<div class="profile-data span10"><?php echo h($artist['Artist']['email']); ?></div>
		<button class="btn mini hover-show">Edit</button>
	</div>
	<div class="row">
		<div class="profile-label span5"><?php echo __('Telephone'); ?></div>
		<div class="profile-data span10"><?php echo h($artist['Artist']['tel']); ?></div>
		<button class="btn mini hover-show">Edit</button>
	</div>
	<div class="row">
		<div class="profile-label span5"><?php echo __('Address'); ?></div>
		<div class="profile-data span10"><?php echo h($artist['Artist']['address']); ?></div>
		<button class="btn mini hover-show">Edit</button>
	</div>
	<div class="row">
		<div class="profile-label span5"><?php echo __('Neighborhood'); ?></div>
		<div class="profile-data span10"><?php echo h($artist['Artist']['neighborhood']); ?></div>
		<button class="btn mini hover-show">Edit</button>
	</div>
	<div class="row">
		<div class="profile-label span5"><?php echo __('TWebsite'); ?></div>
		<div class="profile-data span10"><?php echo h($artist['Artist']['url']); ?></div>
		<button class="btn mini hover-show">Edit</button>
	</div>
	<div class="row">
		<div class="profile-label span5"><?php echo __('Preferred Medium'); ?></div>
		<div class="profile-data span10"><?php echo h($artist['Artist']['medium']); ?></div>
		<button class="btn mini hover-show">Edit</button>
	</div>
	<div class="row">
		<div class="profile-label span5"><?php echo __('Biography'); ?></div>
		<div class="profile-data span10"><?php echo h($artist['Artist']['bio']); ?></div>
		<button class="btn mini hover-show">Edit</button>
	</div>
	<div class="row">
		<button class="btn mini btn-warning ">Deactivate Account</button>
	</div>
<?php if(!empty($artist['Artwork'])): ?>
<div class="related">
	<h3><?php echo __('Artwork for Rent');?></h3>
	<?php
		$i = 0;
		foreach ($artist['Artwork'] as $artwork): ?>
			<div class="row">
				<div class="span3 artwork-title"><?php echo $artwork['title'];?></div>
				<div class="span2 artwork-pieces"><?php echo $artwork['pieces'];?></div>
				<div class="span5 artwork-description"><?php echo $artwork['description'];?></div>
				<div class="span1 artwork-remove"><button class="btn btn-warning mini artwork-remove">Remove</button></div>
			</div>
	<?php endforeach; ?>
	<button class="button btn-warning artwork-add">Add New Artwork</button>
</div>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Artwork'), array('controller' => 'artworks', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
