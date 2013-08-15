<?php $thumbnail = ($artwork['Image'][0]['uri_span3'] !== '')? $artwork['Image'][0]['uri_span3'] : $artwork['Image'][0]['uri']; ?>
<?php $rented = (isset($artwork['Artwork']['is_rented']) && $artwork['Artwork']['is_rented'])? $this->Html->image('rented_sash.png', array('class' => 'rented_sash sash')) : ''; ?>
<?php $purchased = (isset($artwork['Artwork']['is_purchased']) && $artwork['Artwork']['is_purchased'])? $this->Html->image('purchased_sash.png', array('class' => 'purchased_sash sash')) : ''; ?>
<?php //if(isset($artwork['Artwork']['is_rented']) && $artwork['Artwork']['is_rented']) echo $this->Html->image('rented_sash.png', array('class' => 'rented_sash sash')); ?>
<?php //if(isset($artwork['Artwork']['is_purchased']) && $artwork['Artwork']['is_purchased']) echo $this->Html->image('purchased_sash.png', array('class' => 'purchased_sash sash')); ?>

<div class="artwork gallery default span4">
    <?php echo $this->Html->link($this->Matisse->galleryLink($artwork['Artwork']['id'], $this->Html->url($thumbnail), $rented, $purchased), array('controller' => 'artworks', 'action' => 'view', $artwork['Artwork']['id']), array('class' => 'link_matisse gallery_image_link', 'id' => 'artwork_image_id_' . $artwork['Artwork']['id'], 'height' => $this->Matisse->thumbHeight($artwork['Image'][0]['width'], $artwork['Image'][0]['height']), 'escape' => false)) ?>
        <div class="gallery_info">
        <p class="artist-<?php echo $artwork['Artist']['id'] ?> gallery_artist_name"><?php echo $this->Html->link($artwork['Artist']['name'], $this->Matisse->wpLink('artist-profile/#matisse:' . $artwork['Artwork']['artist_id']), array('class' => 'dk-red')) ?></p>
        <div class="artwork-<?php echo $artwork['Artwork']['id'] ?> gallery_actions row">
            <?php echo $this->Html->link('Rent Original', '/carts/rental/' . $artwork['Artwork']['id'], array('class' => 'btn artwork-' . $artwork['Artwork']['id'] . ' rental cart_matisse', 'id' => 'artwork_' . $artwork['Artwork']['id'])); ?>
            <?php if($artwork['Artwork']['rental_only'] !== true): ?>
            <?php echo $this->Html->link('Purchase Original', '/carts/purchase/' . $artwork['Artwork']['id'], array('class' => 'btn artwork-' . $artwork['Artwork']['id'] . ' purchase cart_matisse', 'id' => 'artwork_' . $artwork['Artwork']['id'])); ?>
            <?php endif; ?>
            <?php if($artwork['Artwork']['prints'] !== false): ?>
            <?php echo $this->Html->link('Purchase Print', '/carts/prints/' . $artwork['Artwork']['id'], array('class' => 'btn artwork-' . $artwork['Artwork']['id'] . ' prints cart_matisse', 'id' => 'artwork_' . $artwork['Artwork']['id'])); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="qtip-data" style="display: none" <?php echo $this->Matisse->popover($artwork) ?>></div>
</div>
