<div class="flash_message matisse_flash <?php echo (isset($type))? $type : ''; ?>">
    <span><?php echo ($message)? $message: ''; ?></span>
    <span><?php echo $this->Session->flash(); ?></span>
</div>
<div class="buttons">
    <?php if(!empty($btn)): foreach($btn as $rel => $txt): ?>
        <?php $this->Matisse->modalButton($rel, $txt); ?>
    <?php endforeach; endif; ?>
</div>
