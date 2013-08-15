<h3>Rental Order for Assignment</h3>
<ul style="list-style: none;">
    <li>Client: <?php echo $rental['Client']['name'] ?></li>
    <li>Artwork: <?php echo $rental['Artwork']['title'] ?></li>
    <li>Requested Location: <?php echo $rental['Location']['alias'] ?></li>
    <li>Assignment Link: <?php echo $this->Html->link('Click!', $this->Html->url(array('controller' => 'rentals', 'action' => 'edit', 'admin' => true, $rental['Rental']['id']), true)) ?></li>
</ul>