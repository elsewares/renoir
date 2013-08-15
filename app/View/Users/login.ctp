<div class="row">
    <div class="span7">
        <?php echo $this->Form->create('User', array('class' => 'login_matisse form-horizontal'));
            echo $this->Form->input('username', array('placeholder' => 'email', 'required' => true, 'label' => 'Email'));
            echo $this->Form->input('password', array('placeholder' => 'password', 'required' => true));
            echo $this->Form->input('auto_login', array('type' => 'checkbox', 'label' => 'Remember?')); ?>
            <button class="btn btn-danger submit">Sign In</button>
        <?php echo $this->Form->end(); ?>
        <?php echo $this->Html->link('Forgot Password?', $this->Matisse->wpLink('forgot-password'), array('class' => 'dk-red')); ?>
    </div>
    <div class="span5">
        <?php echo $this->Html->link($this->Matisse->addIcon('plus-sign') . 'Create Client Account', $this->Matisse->wpLink('client-registration'), array('class' => 'btn btn-danger span4 register_button', 'escape' => false)); ?>
        <?php echo $this->Html->link($this->Matisse->addIcon('plus-sign') . 'Create Artist Account', $this->Matisse->wpLink('artist-registration'), array('class' => 'btn btn-danger span4 register_button', 'escape' => false)); ?>
    </div>
</div>
