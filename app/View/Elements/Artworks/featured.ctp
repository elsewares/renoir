<?php $thumbnail = ($artwork['Image'][0]['uri_span3'] !== '')? $artwork['Image'][0]['uri_span3'] : $artwork['Image'][0]['uri']; ?>
<div class="artwork featured span4">
    <?php echo $this->Html->link($this->Matisse->galleryLink($artwork['Artwork']['id'], $this->Html->url($thumbnail)), array('controller' => 'artworks', 'action' => 'view', $artwork['Artwork']['id']), array('class' => 'link_matisse popover_tgt featured_image', 'id' => 'artwork_image_id_' . $artwork['Artwork']['id'], 'escape' => false)) ?>
    <p class="artist-<?php echo $artwork['Artist']['id'] ?> gallery_artist_name"><?php echo $artwork['Artwork']['title'] ?></p>
    <?php //echo $this->Html->link('Rent This Piece Now!', '/carts/rental/' . $artwork['Artwork']['id'], array('class' => 'span3 btn btn-mini btn-danger artwork-' . $artwork['Artwork']['id'] . ' rental cart_matisse', 'id' => 'artwork_' . $artwork['Artwork']['id'])); ?>
</div>
