<h3>Change Featured Image(s)</h3>
<p class="red">Note: Select images with a thumbnail height less than &tilde;240px.</p>
<p>Current Images:</p>
<ul>
    <?php foreach($artworks as $artwork): ?>
    <li><?php echo $artwork['Artwork']['title'] ?> : id = <?php echo $artwork['Artwork']['id'] ?></li>
    <?php endforeach ?>
</ul>
<?php echo $this->Form->create('Artwork'); ?>
    <?php echo $this->Form->input('Site.metadata', array('value' => implode(",", $list))); ?>
<?php echo $this->Form->end('Change'); ?>