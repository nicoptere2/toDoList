<h3>Ajout d'un ami</h3>
<div align="center">
<?php echo $this->Form->create('Friend');
/*
	echo 'Vos amis sont : ';
	foreach ($tableau as $key => $value){ ?>
		<tr>
		 	<?php echo $value ;
		 	echo ',';
		 	?>
		</tr>
    <?php }
    echo '<br>';
    echo 'ajoutez un ami : ';
    */?>
    
    <?php
    //debug($tableau);
    echo $this->Form->input('nom d\'utilisateur', array('label' => 'pseudo', 'placeholder' => 'pseudo','list' => 'friends')); ?>
    <?php echo $this->Form->end('Valider');
?>
</div>