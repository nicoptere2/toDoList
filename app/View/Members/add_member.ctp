<h3>Ajout d'un membre à la liste</h3>
<?php echo $this->Form->create('Member');
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
    echo $this->Form->input('name', array('label' => 'nom', 'placeholder' => 'name')); ?>
    <?php echo $this->Form->end('ajouter'); ?>