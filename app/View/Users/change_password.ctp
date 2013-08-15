<?php if($success): ?>
    <div class="shadow-box span3">
        <p>Password reset!</p>
    </div>
<?php else: ?>
    <div class="shadow-box">
        <?php echo $this->Html->link('Uh oh.  Please try again', Configure::read('Matisse.front') . 'my-account/', array('class' => 'btn btn-danger span3')); ?>
    </div>
<?php endif; ?>