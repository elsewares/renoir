<div class="user existing">
    <p>Hello there, <?php echo $user['username']; ?>, you're already registered with the site.</p>
    <p>At the moment, a user can only be registered as an artist or client - but we're working on it!</p>
    <p><?php echo $this->Html->link('My Profile', array('controller' => 'user', 'action' => 'view', $user['id'], 'class' => 'btn btn-warning')); ?></p>
</div>