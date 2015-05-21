<div class="span8">
	<div class="page-header">
		<h1 align="center">Désinscription</h1>
	</div>
	
	<center><br>Voulez-vous vraiment vous désinscrire ? <br><br>
	Vous perdrez toutes vos données. <br><br>
	Cette action est irréversible.<br><br><br><br>
</div>
<center>
<?php
echo $this->Form->create('User', array('action'=>'delete'));
echo $this->Form->hidden('wantDeletion', array('value'=>'1'));
echo $this->Form->submit('Oui', array('after' => $this->Html->link("Non", array('controller' => 'users','action'=> 'monprofile'), array( 'class' => 'button'))));
?>

</center>
