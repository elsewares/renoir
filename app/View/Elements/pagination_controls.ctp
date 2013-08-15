<?php 
echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled'));
echo $this->Paginator->numbers();
echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled'));
?>