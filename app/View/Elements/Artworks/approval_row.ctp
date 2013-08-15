<div class="artwork artist_related artwork_<?php echo $artwork['Artwork']['id'] ?> row">
    <div class="span3 featured_image">
        <img src="<?php echo $this->Html->url($artwork['Image'][0]['uri']); ?>"  class="span3 thumbnail"/>
        <div class="shadow-box"><label for="approve">Approve? <?php echo $this->Form->checkbox('approve.' . $artwork['Artwork']['id'], array('hiddenField' => true, 'value' => $artwork['Artwork']['id'], 'class' => '')); ?></label></div>
        <div class="shadow-box"><label for="approve">Reject? <?php echo $this->Form->checkbox('reject.' . $artwork['Artwork']['id'], array('hiddenField' => true, 'value' => $artwork['Artwork']['id'], 'class' => '')); ?></label></div>
 
    </div>
    <div class="span4 information">
        <ul>
            <li><h3><?php echo  $artwork['Artwork']['title'] ?></h3></li>
            <li><p><?php echo $artwork['Artwork']['description'] ?></p></li>
            <li>Dimensions: <?php echo $this->Matisse->regexDimensions($artwork['Artwork']['dimensions']); ?></li>
            <li>Custom Sizes Available: <?php echo ($artwork['Artwork']['custom'])? 'Yes' : 'No' ?></li>
            <li>Prints Available: <?php echo ($artwork['Artwork']['prints'])? 'Yes' : 'No' ?></li>
            <li>Purchase Price: $<?php echo $artwork['Artwork']['price'] ?></li>
            <?php if($artwork['Artwork']['prints']): ?>
                <li>Print Price: $<?php echo $artwork['Artwork']['print_price'] ?></li>
			<?php endif; ?>
        </ul>
    </div>
</div>