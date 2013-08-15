<div class="row">
    <ul class="span7 purchase_buttons">
        <li class="span6"><?php echo $this->Html->link($this->Matisse->addIcon('shopping-cart') . 'Purchase Artwork', array('controller' => 'carts', 'action' => 'purchase', $artwork['Artwork']['id']), array('class' => 'btn btn-danger cart_matisse span3', 'id' => 'artwork-' . $artwork['Artwork']['id'], 'escape' => false)); ?></li>
        <li class="span6"><?php echo $this->Html->link($this->Matisse->addIcon('home') . 'Rent Artwork', array('controller' => 'carts', 'action' => 'rental', $artwork['Artwork']['id']), array('class' => 'btn btn-danger cart_matisse span3', 'escape' => false)); ?></li>
        <li class="span6"><?php echo $this->Html->link($this->Matisse->addIcon('picture') . 'Purchase Print', array('controller' => 'carts', 'action' => 'prints', $artwork['Artwork']['id']), array('class' => 'btn btn-danger cart_matisse span3', 'escape' => false)); ?></li>
    </ul>
</div>