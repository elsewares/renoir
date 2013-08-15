<?php if(!empty($orderItem['OrderItem'])): ?>
<div class="item_row row shadow-box">
    <div class="span3 red item_title">
        <?php echo $this->Html->link($orderItem['OrderItem']['title'], array('controller' => 'artworks', 'action' => 'view', $orderItem['OrderItem']['artwork_id']), array('class' => 'link_matisse red')) ?>
    </div>
    <div class="span3 item_type"><?php echo (ucfirst($orderItem['OrderItem']['item_type']) == "Rental")? "Rental (3 months)" : ucfirst($orderItem['OrderItem']['item_type']); ?></div>
    <div class="span3 offset1 item_amount"><?php echo "$  " . ($orderItem['OrderItem']['amount'] !== '')? "$  " . $orderItem['OrderItem']['amount'] : "$  0.00" ?></div>
    <div class="span1 item_remove"><?php echo $this->Html->link($this->Matisse->addIcon('remove-circle', false) . ' Remove', array('controller' => 'carts', 'action' => 'remove', $orderItem['OrderItem']['artwork_id']), array('class' => 'link_matisse btn span1 item_remove', 'target' => '_parent', 'escape' => false)) ?>
</div>
</div>
<?php else: ?>
<div class="item_row row shadow-box">
    <div class="span3 red item_title">
        <?php echo $this->Html->link($orderItem['Artwork']['title'], array('controller' => 'artworks', 'action' => 'view', $orderItem['Artwork']['id']), array('class' => 'link_matisse red')) ?>
    </div>
    <div class="span3 item_type"><?php echo (ucfirst($orderItem['item_type']) == "Rental")? "Rental (3 months)" : ucfirst($orderItem['item_type']); ?></div>
    <div class="span3 offset1 item_amount"><?php echo "$  " . ($orderItem['amount'] !== '')? "$  " . $orderItem['amount'] : "$  0.00" ?></div>
    <div class="span1 item_remove"><?php echo $this->Html->link($this->Matisse->addIcon('remove-circle', false) . ' Remove', array('controller' => 'carts', 'action' => 'remove', $orderItem['Artwork']['id']), array('class' => 'link_matisse btn span1 item_remove', 'escape' => false, 'target' => '_parent')) ?></div>
</div>
<?php endif ?>