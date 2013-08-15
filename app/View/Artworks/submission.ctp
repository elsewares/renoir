<?php   if($count < 5 && $artist['Artist']['restricted'] == true){
            $_remain = $remain = 5 - $count;
            $num = 1;
        } else {
            $num = $count + 1;
            $_remain = 'unlimited';
        }
        ?>
        
<?php if($count < 5 || $artist['Artist']['restricted'] == false): ?>
<div class="container">
<div class="row">
    <div class="divitis span7">
        <div class="artworks submission form">
        <?php echo $this->element('errors'); ?>
            <?php echo $this->Form->create('Artwork', array('class' => 'artwork_submission submission_' . $num, 'enctype' => 'multipart/form-data' ));?>
                <fieldset>
                    <legend><?php echo __('Artwork Submission Form'); ?></legend>
                    <?php
                        echo $this->Form->hidden('artist_id', array('value' => $artist['Artist']['id']));
                        echo $this->Form->hidden('is_submission', array('value' => true));
                        echo $this->Form->hidden('active', array('value' => false));
                        echo $this->Form->input('title', array('placeholder' => 'Starry Night', 'error' => false));
                        echo $this->Form->input('description', array('placeholder' => 'Oil painting by Vincent van Gogh.', 'type' => 'text', 'error' => false)); ?>
                        <div class="input text micro-inputs">
                            <label class="div-label">Dimensions</label>
                            <div class="dimension-container">
                                <?php echo $this->Form->input('dimensions-h', array('class' => 'input-inline input-micro', 'label' => 'H', 'div' => false)); ?> <span class="dim-label">in</span>
                                <?php echo $this->Form->input('dimensions-w', array('class' => 'input-inline input-micro', 'label' => 'W', 'div' => false)); ?> <span class="dim-label">in</span>
                                <?php echo $this->Form->input('dimensions-d', array('class' => 'input-inline input-micro', 'label' => 'D', 'div' => false)); ?> <span class="dim-label">in</span>
                                <?php echo $this->Form->hidden('dimensions'); ?>
                            </div>
                        </div>
                    <?php
                        //echo $this->Form->input('pieces', array('type' => 'text'));
                        echo $this->BootstrapForm->input('price', array(
                            'label' => 'Original Price',
                            'type' => 'text',
                            'class' => '',
                            'value' => '0.00',
                            'prepend' => '$',
                            'helpBlock' => 'Do not enter the dollar sign in the field.',
                            'div' => array('class' => 'input text')));
                        echo $this->Form->input('rental_only', array('label' => 'Original not for sale (rental only)?'));
                        echo $this->Form->input('custom', array('label' => 'Custom Sizing Available?'));
                        echo $this->Form->input('prints', array('label' => 'Prints Available?'));
                        echo $this->BootstrapForm->input('print_price', array(
                            'label' => 'Price per Print',
                            'type' => 'text',
                            'class' => '',
                            'value' => '0.00',
                            'prepend' => '$',
                            'helpBlock' => 'Do not enter the dollar sign in the field.',
                            'div' => array('class' => 'input text')));
                        echo $this->Form->input('image', array('type' => 'file'));
                        ?>
                        <p class="small dk-red upload_warning">Files must be in .png, .jpg/jpeg, or .bmp format, and under 7MB in size.</p>
                </fieldset>
            <?php $this->Matisse->submitButton('Submit Artwork', array('artsubform', 'submission_' . $num)); ?>        
            <?php echo $this->Form->end();?>
        </div>
    </div> <!-- .span9 form container -->
    <div class="submission_info span5">
        <div class="artworks count">
            <p class="submission_count span4">You have made <span class="remaining"><?php echo $count ?></span> submissions.</p>
            <p class="submission_count span4">You have <span class="remaining"><?php echo $_remain ?></span> submissions remaining.</p>
            <?php echo $this->Html->link('I\'m finished with my submissions.', $this->Matisse->wpLink('artist-profile'), array('class' => 'btn btn-danger span4', 'target' => '_top')); ?>
        </div>
    </div>
</div><!-- .row -->
</div><!-- .container -->
<?php echo $this->Html->script('submissions'); ?>
<?php endif; ?>
<?php if($count == 5 && $artist['Artist']['restricted'] == true): ?>
<div class="artworks no_remaining finish">
    <p>You have no remaining submissions.</p>
    <p>Check your artist profile for your HangItUp <span class="red">CHICAGO</span> artwork's submission status.</p>
    <p><?php echo $this->Html->link('View my Artist Profile', $this->Matisse->wpLink('artist-profile'), array('class' => 'btn span2', 'target' => '_top')); ?></p>
    <p><?php echo $this->Html->link('Go to the Gallery', $this->Matisse->wpLink('gallery'), array('class' => 'btn span2', 'target' => '_top')); ?></p>
</div>

<?php endif; ?>
