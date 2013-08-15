<div class="row">
    <div class="span7">
        <h3>The Lists</h3>
        <ul class="span6">
            <li><?php echo $this->Html->link('Users List', array('controller' => 'users', 'action' => 'index', 'admin' => true), array('class' => 'btn btn-danger span3')) ?></li>
            <li><?php echo $this->Html->link('Artists List', array('controller' => 'artists', 'action' => 'index', 'admin' => true), array('class' => 'btn btn-danger span3')) ?></li>
            <li><?php echo $this->Html->link('Clients List', array('controller' => 'clients', 'action' => 'index', 'admin' => true), array('class' => 'btn btn-danger span3')) ?></li>
            <li><?php echo $this->Html->link('Artworks List', array('controller' => 'artworks', 'action' => 'index', 'admin' => true), array('class' => 'btn btn-danger span3')) ?></li>
            <li><?php echo $this->Html->link('Orders List', array('controller' => 'orders', 'action' => 'index', 'admin' => true), array('class' => 'btn btn-danger span3')) ?></li>
            <li><?php echo $this->Html->link('Locations List', array('controller' => 'locations', 'action' => 'index', 'admin' => true), array('class' => 'btn btn-danger span3')) ?></li>
        </ul>
        <h3>Actions</h3>
        <ul class="span6">
            <li><?php echo $this->Html->link('Add Artwork Purchase/Rental', array('controller' => 'orders', 'action' => 'add', 'admin' => true), array('class' => 'btn btn-danger span3')); ?></li>
            <li><?php echo $this->Html->link('Manage Rentals', array('controller' => 'rentals', 'action' => 'index', 'admin' => true), array('class' => 'btn btn-danger span3')); ?></li>
            <li><?php echo $this->Html->link('Approve Artworks', array('controller' => 'artworks', 'action' => 'approve', 'admin' => true), array('class' => 'btn btn-danger span3')); ?></li>
            <li><?php echo $this->Html->link('Change Featured Artwork', array('controller' => 'sites', 'action' => 'change_featured', 'admin' => true), array('class' => 'btn btn-danger span3')); ?></li>
        </ul>
    </div>
</div>
