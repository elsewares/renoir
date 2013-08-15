<?php echo $this->Form->create('Artwork', array('class' => 'matisse-search form-search')) ?>
    <?php //echo $this->Form->input('Artwork.keywords', array('div' => false, 'label' => '', 'class' => 'search-query')); ?>
    <?php echo $this->Form->hidden('Artwork.from', array('value' => 'searchbar')); ?>
    <?php echo $this->Matisse->submitButton('Search Artwork', array('search_matisse', 'btn-danger')); ?>
<?php echo $this->Form->end() ?>