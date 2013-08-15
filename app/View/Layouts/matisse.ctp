  <?php if(!isset($modal)): ?>
    <div class="from_matisse">  
      <?php echo $this->Session->flash(); ?>
      <?php echo $this->Session->flash('auth'); ?>

      <?php echo $this->fetch('content'); ?>
      <?php echo $this->element('hidden_matisse'); ?>
    </div>
  <?php else: ?>
    <div class="modal_matisse">
      <?php echo $this->fetch('content'); ?>
      <?php echo $this->element('hidden_matisse'); ?>
    </div>
  <?php endif; ?>
<?php //echo debug($user); ?>