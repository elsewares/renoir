<div class="user existing">
    <p>Hello there, <?php echo $user['username']; ?>, you're already registered with the site.</p>
    <p>At the moment, a user can only register as an artist <em>or</em> client - but we're working on it!</p>
    <p>Sincerely,</p>
    <p><em>The HangItUp Chicago Web Gremlins</em></p>
    <p><?php echo $this->Html->link('My Profile', $this->Html->url(Configure::read('Matisse.front') . $role . '-profile/'), array('class' => 'btn btn-warning')); ?></p>
</div>