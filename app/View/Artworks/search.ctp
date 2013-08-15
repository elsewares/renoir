<div class="artworks search">
    <?php echo $this->element('Artworks/search_page_forms'); ?>
    <?php if(isset($result)): ?>
        <?php if(!empty($result)): ?>
        <div class="artwork search-results">
            <h3 class="dk-red">Search Results</h3>
            <?php $row = 0; echo '<div class="row">'; ?>
            <?php foreach ($result as $artwork): ?>
                    <?php echo $this->element('Artworks/gallery', array('artwork' => $artwork)); $row++; ?>
                <?php if($row % 3 == 0) echo '</div><div class="row">'; ?>
            <?php endforeach; echo '</div>'; ?>
        </div>
        <?php else: ?>
        <div class="artwork search-results">
            <h3 class="dk-red">Search Results</h3>
            <p class="dr-red">No search results yet.</p>
        </div>
        <?php endif; ?>
    <?php endif; ?>
</div>