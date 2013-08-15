<div class="artworks form">
    <?php echo $this->Form->create('Artwork', array('class' => 'artwork_submission', 'enctype' => 'multipart/form-data' ));?>
        <fieldset>
            <legend><?php echo __('Edit ' . $this->request->data['Artwork']['title']); ?></legend>

            <?php
                echo $this->Form->hidden('artist_id');
                echo $this->Form->hidden('is_submission');
                echo $this->Form->hidden('active');
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
						'value' => $this->request->data('Artwork.price'),
						'name' => 'data[Artwork][price]',
						'class' => '',
						'prepend' => '$',
						'helpBlock' => 'Do not enter the dollar sign in the field.',
						'div' => array('class' => 'input text')));
					echo $this->Form->input('rental_only', array('label' => 'Original not for sale (rental only)?'));
					echo $this->Form->input('custom', array('label' => 'Custom Sizing Available?'));
					echo $this->Form->input('prints', array('label' => 'Prints Available?'));
					echo $this->BootstrapForm->input('print_price', array(
						'label' => 'Price per Print',
						'type' => 'text',
						'name' => 'data[Artwork][print_price]',
						'value' => $this->request->data('Artwork.print_price'),
						'class' => '',
						'prepend' => '$',
						'helpBlock' => 'Do not enter the dollar sign in the field.',
						'div' => array('class' => 'input text')));
                ?>
        </fieldset>
    <?php $this->Matisse->submitButton('Save Edits'); ?>        
    <?php echo $this->Form->end();?>
</div>
