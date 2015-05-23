<h3>Suppression d'un ami</h3>
<div align="center">
<?php echo $this->Form->create('Friend');
?>
    <div align="center">
    <?php 
    foreach ($tableau as $key => $value){
        //debug($value);
        $options[$value] = $value;
    }
    //debug($options);
    echo $this->Form->input('nom d\'utilisateur', array('options' => $options)); ?>
    <?php echo $this->Form->end('Valider'); ?>
</div>