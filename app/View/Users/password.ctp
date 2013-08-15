<?php if($get): ?>
<div class="row">
    <div class="span5">
        <p>Enter the email address that you used to register with <span class="dk-red">HangItUp CHICAGO</span>, and click submit.  A new password will be sent to that email address if we find it in our database.</p>
        <p>If you can't remember the email you used to register, please contact the site administrator.</p>
        <?php echo $this->Form->create('User', array('class' => 'matisse form-horizontal'));
                echo $this->Form->input('username', array('placeholder' => 'email', 'required' => true, 'label' => 'Email')); 
                echo $this->Matisse->submitButton('Send Password', array('btn-danger')); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
<?php elseif ($password_sent): ?>
<div class="row">
    <div class="span5 alert">
    <a class="close" data-dismiss="alert" href="#">×</a>
        <p>Your request has been sent to the server.  Be sure to check your spam folder, just in case.</p>
    </div>
</div>
<?php else: ?>
<div class="row">
    <div class="span5 alert">
        <p>An error has occured on the server.  Please try again.</p>
        <?php echo $this->Form->create('User', array('class' => 'matisse form-horizontal'));
                echo $this->Form->input('username', array('placeholder' => 'email', 'required' => true, 'label' => 'Email')); 
                echo $this->Matisse->submitButton('Send Password', array('btn-danger')); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
<?php endif; ?>