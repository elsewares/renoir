<div class="artworks form">
    <?php echo $this->Form->create('Artwork', array('class' => 'artwork_add form-horizontal', 'enctype' => 'multipart/form-data' ));?>
        <fieldset>
            <?php
                echo $this->Form->hidden('artist_id', array('value' => $user['id']));
                echo $this->Form->hidden('is_submission', array('value' => true));
                echo $this->Form->hidden('active', array('value' => false));
                echo $this->Form->input('title');
                echo $this->Form->input('description'); ?>
                <div class="input text micro-inputs">
                    <label class="div-label">Dimensions</label>
            <?php
                echo $this->Form->input('dimensions-h', array('class' => 'input-inline input-micro', 'label' => 'H', 'div' => false));
                echo $this->Form->input('dimensions-w', array('class' => 'input-inline input-micro', 'label' => 'W', 'div' => false));
                echo $this->Form->input('dimensions-d', array('class' => 'input-inline input-micro', 'label' => 'D', 'div' => false));
                echo $this->Form->hidden('dimensions');
            ?>
                </div>
            <?php
				echo $this->BootstrapForm->input('price', array(
					'label' => 'Original Price',
					'type' => 'text',
					'class' => '',
					'prepend' => '$',
					'helpBlock' => 'Do not enter the dollar sign in the field.',
					'div' => array('class' => 'input text')));
				echo $this->Form->input('custom', array('label' => 'Custom Sizing'));
				echo $this->Form->input('prints', array('label' => 'Prints Available'));
				echo $this->BootstrapForm->input('print_price', array(
					'label' => 'Price per Print',
					'type' => 'text',
					'class' => '',
					'prepend' => '$',
					'helpBlock' => 'Do not enter the dollar sign in the field.',
					'div' => array('class' => 'input text')));
                ?>
        </fieldset>
    <?php $this->Matisse->submitButton('Submit Artwork'); ?>        
    <?php echo $this->Form->end();?>
</div>