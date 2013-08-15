<div>
    <h3>This account hasn't been activated yet.</h3>
    <p>If you'd like another activation email to be sent to you, enter the email address and click 'Send'.</p>
    <?php echo $this->Form->create('User');?>
        <fieldset>
            <legend><?php echo __('Resend Activation Email'); ?></legend>
        <?php
            echo $this->Form->input('username', array('label' => 'Email'));
        ?>
        </fieldset>
    <?php echo $this->Matisse->submitButton('Email Me'); ?>
</div>