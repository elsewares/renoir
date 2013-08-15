<?php $terms = $this->Html->link('Terms of Service', $this->Matisse->wpLink('wp-content/uploads/2012/05/ToS_[PRODUCTION_URL]_.pdf/'), array('target' => '_new')); ?>
<?php $priv = $this->Html->link('Privacy Policy', $this->Matisse->wpLink('privacy/'), array('target' => '_new')); ?>
<p class="terms">By clicking the checkbox below, you are agreeing to the HangItUp Chicago <?php echo $terms ?>, as well as the HangItUp Chicago <?php echo $priv ?>.</p>
