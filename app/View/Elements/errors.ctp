<?php // View/Elements/errors.ctp
if (!empty($errors)) { ?>
<div class="errors">
    <h3>There are <?php echo count($errors); ?> error(s) in your submission:</h3>
    
    <ul>
        <?php foreach ($errors as $field => $error): ?>
        <li class="dk-red"><?php echo $error[0]; ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php } ?>