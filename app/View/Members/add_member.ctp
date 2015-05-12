<h3>Ajout d'un membre à la liste</h3>
<?php echo $this->Form->create('Member');
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
    echo $this->Form->input('pseudo', array('label' => 'pseudo', 'placeholder' => 'pseudo','list' => 'friends')); ?>
    <datalist id="friends">
    	<?php 
        debug($tableau);
        foreach ($tableau as $key => $value){ ?>
    	<?php echo "<option value='$value'>"; ?>
    	<?php } ?>
    </datalist>
    <?php echo $this->Form->end('Valider'); ?>