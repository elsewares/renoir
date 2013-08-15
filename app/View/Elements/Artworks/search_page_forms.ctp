<div class="row">
    <?php echo $this->Form->create('Artwork', array('class' => 'span4 shadow-box')); ?>
        <?php echo $this->Form->hidden('searchtype', array('value' => 'keyword')); ?>
        <?php echo $this->Form->input('keywords', array('class' => 'span3', 'div' => false, 'label' => 'Search by Keyword')); ?>
        <?php echo $this->Matisse->submitButton('Keyword Search', array('span2', 'btn-danger')); ?>
    <?php echo $this->Form->end(); ?>
    <?php echo $this->Form->create('Artwork', array('class' => 'span4 form-inline shadow-box')); ?>
        <?php echo $this->Form->hidden('searchtype', array('value' => 'price')); ?>
        <div class="span3 no-gutter">
            <span class="price_form_label">Search by Price</span>
            <?php echo $this->Form->input('low_price', array('class' => 'span1', 'div' => false, 'label' => '$ ')); ?>
            <span class="search_price_to"> to </span>
            <?php echo $this->Form->input('high_price', array('class' => 'span1', 'div' => false, 'label' => '$ ')); ?>
        </div>
        <?php echo $this->Matisse->submitButton('Price Search', array('span2', 'btn-danger price_button')); ?>
    <?php echo $this->Form->end(); ?>
    <?php echo $this->Form->create('Artwork', array('class' => 'span4 shadow-box')); ?>
        <?php echo $this->Form->hidden('searchtype', array('value' => 'size')); ?>
        <?php echo $this->Form->input('size', array('value' => 'size', 'options' => array('small', 'medium', 'large', 'x-large'), 'empty' => '(choose)', 'class' => 'span3', 'div' => false, 'label' => 'Search by Size')); ?>
        <?php echo $this->Matisse->submitButton('Size Search', array('span2', 'btn-danger')); ?>
    <?php echo $this->Form->end(); ?>
</div>