<h3>Ajout d'un membre à la liste</h3>
<div align="center">
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
    	<?php foreach ($tableau as $key => $value){ ?>
    	<?php echo "<option value='$value'>"; ?>
    	<?php } ?>
    </datalist>

    
    <table style="width:80%">
    <tr>
        <td>
            <?php 
                echo $this->Form->input('conditions', array('label' => "Add Item", 'type' => 'checkbox', 'checked' => 'checked',));
            ?>
        </td>
        <td>
            <?php 
                echo $this->Form->input('conditions', array('label' => "Add User", 'type' => 'checkbox', 'checked' => 'checked',));
            ?>
        </td>
    </tr>
    </table>
<?php echo $this->Form->end('Valider'); ?>
</div>