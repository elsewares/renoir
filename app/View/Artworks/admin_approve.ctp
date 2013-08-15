<?php if(isset($approvals) || isset($rejections)): ?>
<div class="artworks approve">
    <h3>Approvals</h3>
    <ul>
        <?php foreach($approvals as $app): ?>
        <li><?php echo $app; ?></li>
        <?php endforeach; ?>
    </ul>
    <h3>Rejections</h3>
    <ul>
        <?php foreach($rejections as $rej): ?>
        <li><?php echo $rej; ?></li>
        <?php endforeach; ?>
    </ul>
    <h3>Artist Made Unlimited</h3>
    <p><?php echo $unlimited ?></p>
</div>
<?php else: ?>
    <div class="artworks approve">
    <?php echo $this->Form->create('Artwork'); ?>
        <?php foreach($artworks as $artwork): ?>
            <?php $artist_name = $artwork['Artist']['name']; ?>
            <h2><?php echo $artist_name; ?></h2>
            <?php echo $this->element('Artworks/approval_row', array('artwork' => $artwork)); ?>
       <?php endforeach; ?>
        <?php $this->Matisse->submitButton('Submit Approvals'); ?>
    <?php echo $this->Form->end();?>
    </div>
<?php endif; ?>