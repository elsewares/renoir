<div class="navbar">
  <div class="navbar-inner">
    <div class="container">
      <?php echo $this->Html->link('HangItUp CHICAGO', array('controller' => 'pages', 'admin' => true), array('class' => 'brand dk-red')); ?>
      <ul class="nav">
        <li class="active"><?php echo $this->Html->link('Home', array('controller' => 'pages', 'admin' => true), array('class' => '')); ?></li>
        <li><?php echo $this->Html->link('Clients', array('controller' => 'clients', 'admin' => true), array('class' => '')); ?></li>
        <li><?php echo $this->Html->link('Locations', array('controller' => 'locations', 'admin' => true), array('class' => '')); ?></li>            
        <li><?php echo $this->Html->link('Artists', array('controller' => 'artists', 'admin' => true), array('class' => '')); ?></li>
        <li><?php echo $this->Html->link('Artworks', array('controller' => 'artworks', 'admin' => true), array('class' => '')); ?></li>
        <li><?php echo $this->Html->link('Orders', array('controller' => 'orders', 'admin' => true), array('class' => '')); ?></li>
        <li><?php echo $this->Html->link('Rentals', array('controller' => 'rentals', 'admin' => true), array('class' => '')); ?></li>     
        <li><?php echo $this->Html->link('Users', array('controller' => 'users', 'admin' => true), array('class' => '')); ?></li>  
      </ul>
      <?php if(!$this->Session->read('Auth.User')): ?>
            <form action="/matisse/users/login" class="pull-right" method="post" accept-charset="utf-8">
                <input name="data[User][username]" class="input-small" placeholder="email" maxlength="50" type="text" id="UserUsername">
                <input name="data[User][password]" class="input-small" placeholder="password" type="password" id="UserPassword">
                <button class="btn" type="submit">Sign in</button>
            </form>
      <?php else: ?>
        <ul class="nav secondary-nav">
            <li class="menu">
                <a href="#" class="menu"><?php echo $this->Session->read('Auth.User.username'); ?></a>
            </li>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</div>
