<div>
    <ul>
    <?php foreach($approvals as $approval): ?>
        <?php echo '<li>' . $approval . '</li>'; ?>
    <?php endforeach; ?>
    </ul>
</div>
<div>
    <ul>
    <?php foreach($rejections as $rejection): ?>
        <?php echo '<li>' . $rejection . '</li>'; ?>
    <?php endforeach; ?>
    </ul>
</div>