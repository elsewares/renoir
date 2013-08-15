<div class="artists artist_view artist-<?php echo $artist['Artist']['id'] ?> container">
	<div class="row">
		<div class="span7 artist_information">
			<h2 class="subheader"><?php echo $artist['Artist']['name'] ?></h2>
			<ul class="profile">
				<li><span class="profile_label">Neighborhood: </span><?php echo $artist['Artist']['neighborhood']; ?></li>
				<li><span class="profile_label">Medium: </span><?php echo $artist['Artist']['medium']; ?></li>
				<li><span class="profile_label">Bio &amp; Artist Statement: </span></li>
				<li><p class="profile_bio span7"><?php echo $artist['Artist']['bio']; ?></p></li>
			</ul>
		</div>	
	<?php if(!empty($owner) && $owner !== false): ?>
		<div class="span5 profile_actions">
			<ul>
				<li><?php echo $this->Html->link($this->Matisse->addIcon('pencil') . 'Edit My Profile', 'edit/' . $artist['Artist']['id'], array('class' => 'btn btn-danger link_matisse span3', 'escape' => false)); ?></li>
				<li><?php echo $this->Html->link($this->Matisse->addIcon('picture') . 'Submit Additional Work', array('controller' => 'artworks', 'action' => 'submission', $artist['Artist']['id']), array('class' => 'btn btn-danger link_matisse span3', 'escape' => false)); ?></li>
			</ul>
		</div>
	<?php endif; ?>
	</div>
	<h1 class="subheader">Artwork</h1>
	<?php if(!empty($artworks)): ?>
		<div class="artwork_container">
			<?php foreach($artworks as $artwork): ?>
				<?php if($artwork['Artwork']['active'] == true && $artwork['Artwork']['is_submission'] == false): ?>
					<?php echo $this->element('Artworks/submission_row', $artwork); ?>
				<?php endif ?>
			<?php endforeach; ?>
		</div>
	<?php else: ?>
		<p>No submissions for this artist, yet.  Check back soon!</p>
	<?php endif; ?>
	<?php if(!empty($owner) && $owner !== false): ?>
		<h2 class="subheader">Pending Submissions</h1>
		<?php if(!empty($artworks)): ?>
			<div class="artwork_container">
				<?php foreach($artworks as $artwork): ?>
					<?php if($artwork['Artwork']['active'] == false && $artwork['Artwork']['is_submission'] == true): ?>
						<?php echo $this->element('Artworks/submission_row', $artwork); ?>
					<?php endif ?>
				<?php endforeach; ?>
			</div>
		<?php else: ?>
			<p>No pending artwork submissions.</p>
		<?php endif ?>
		<h2 class="subheader">Unaccepted Submissions</h1>
		<?php if(!empty($artworks)): ?>
			<div class="artwork_container">
				<?php foreach($artworks as $artwork): ?>
					<?php if($artwork['Artwork']['active'] == false && $artwork['Artwork']['is_submission'] == false): ?>
						<?php echo $this->element('Artworks/submission_row', $artwork); ?>
					<?php endif ?>
				<?php endforeach; ?>
			</div>
		<?php else: ?>
			<p>No unaccepted submissions.</p>
		<?php endif ?>
	<?php endif; ?>
</div>
	
