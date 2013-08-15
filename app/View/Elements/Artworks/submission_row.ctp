<div class="artwork artist_related artwork_<?php echo $Artwork['id'] ?> row">
    <div class="span3 featured_image">
        <img src="<?php echo $this->Html->url($Image[0]['uri']); ?>"  class="span3 thumbnail"/>
    </div>
    <div class="span4 information">
        <ul>
            <li><h3><?php echo  $Artwork['title'] ?></h3></li>
            <li><p><?php echo $Artwork['description'] ?></p></li>
            <li>Dimensions: <?php echo $this->Matisse->regexDimensions($Artwork['dimensions']); ?></li>
            <li>Custom Sizes Available: <?php echo ($Artwork['custom'])? 'Yes' : 'No' ?></li>
            <li>Prints Available: <?php echo ($Artwork['prints'])? 'Yes' : 'No' ?></li>
            <li>Purchase Price: $<?php echo $Artwork['price'] ?></li>
            <?php if($Artwork['prints']): ?>
                <li>Print Price: $<?php echo $Artwork['print_price'] ?></li>
            <?php endif; ?>
            <?php if($Artwork['is_submission']): ?>
                <li>Accepted: <?php echo ($Artwork['active'])? 'Yes' : 'Waiting'; ?>
            <?php endif; ?>
            <?php if($Artwork['active']): ?>
                <li>Rental Status: <?php echo ($Artwork['is_rented'])? 'On Rental' : 'Available'; ?></li>
                <?php if(!empty($owner) && $Artwork['is_rented']): ?>
                <li>
                    <p class="red rental_status">Rented to <?php echo $Rental[0]['Client']['name'] ?> until <?php echo substr($Rental[0]['end_date'], 0, 10) ?>.</p> 
                </li>
                <?php endif ?>
            <?php endif; ?>
        </ul>
    </div>
    <div class="artwork_actions span3">
		<?php if(!empty($owner)) echo $this->Html->link($this->Matisse->addIcon('pencil') . 'Edit Artwork', array('controller' => 'artworks', 'action' => 'edit', $Artwork['id']), array('class' => 'btn btn-warning link_matisse span3', 'escape' => false)); ?>	
        <?php if(!empty($owner)) echo $this->Html->link($this->Matisse->addIcon('remove-circle') . 'Delete Artwork', array('controller' => 'artworks', 'action' => 'remove', $Artwork['id']), array('class' => 'btn btn-danger link_matisse span3', 'escape' => false)); ?>	
        <?php if(empty($Rental) && empty($owner)): ?>
            <?php echo $this->Html->link('Purchase Original', array('controller' => 'carts', 'action' => 'purchase', $Artwork['id']), array('class' => 'btn info cart_matisse btn-danger span2', 'id' => 'artwork-' . $Artwork['id'])); ?>
            <?php echo $this->Html->link('Rent Artwork', array('controller' => 'carts', 'action' => 'rental', $Artwork['id']), array('class' => 'btn btn-danger cart_matisse span2', 'id' => 'artwork-' . $Artwork['id'])); ?>
        <?php else: ?>
            <?php echo $this->Html->link('Purchase Original', array('controller' => 'carts', 'action' => 'purchase', $Artwork['id']), array('class' => 'btn info cart_matisse btn-danger span2', 'id' => 'artwork-' . $Artwork['id'])); ?>
        <?php endif ?>
    </div>
</div>
