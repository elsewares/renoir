<?php   if($count < 5):
        $_remain = $remain = 5 - $count;
        $num = 1; ?>
<div class="container">
<div class="row">
    <div class="divitis span7">
        <?php while($remain > 0): ?>
        <div class="artworks submission form">
            <?php echo $this->Form->create('Artwork', array('class' => 'artwork_submission submission_' . $num, 'enctype' => 'multipart/form-data' ));?>
                <fieldset>
                    <legend><?php echo __('Submission #' . ($num)); ?></legend>
                    <?php
                        echo $this->Form->hidden('artist_id', array('value' => $artist['Artist']['id']));
                        echo $this->Form->hidden('is_submission', array('value' => true));
                        echo $this->Form->hidden('active', array('value' => false));
                        echo $this->Form->input('title', array('placeholder' => 'Starry Night'));
                        echo $this->Form->input('description', array('placeholder' => 'Oil painting by Vincent van Gogh.', 'type' => 'text')); ?>
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
                        echo $this->Form->input('pieces');
                        echo $this->Form->input('price', array('placeholder' => 1000.00));
                        echo $this->Form->input('image', array('type' => 'file'));
                        ?>
                </fieldset>
            <?php $this->Matisse->submitButton('Submit Artwork', array('artsubform', 'submission_' . $num)); ?>        
            <?php echo $this->Form->end();?>
        </div>
        <?php $remain--; $num++; endwhile; ?>
    </div> <!-- .span9 form container -->
    <div class="submission_info span5">
        <div class="artworks count">
            <p class="submission_count span4">You have made <span class="remaining"><?php echo $count ?></span> submissions.</p>
            <p class="submission_count span4">You have <span class="remaining"><?php echo $_remain ?></span> submissions remaining.</p>
        </div>
    </div>
</div><!-- .row -->
</div><!-- .container -->
<?php echo $this->Html->script('submissions'); ?>
<?php endif; ?>
<?php if($count == 5): ?>
<div class="artworks no_remaining"><p>You have no remaining submissions.  Please check your artist profile for your submission status.</p></div>
<?php endif; ?>
