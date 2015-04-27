<!DOCTYPE html>
<html>
<head>
<style>
label

{

    display: block;

    width: 150px;


} 
</style>
</head>
<body>

<h3 align="center">Ajout d'un élément</h3>
<?php echo $this->Form->create('Task'); ?>
    <?php echo $this->Form->input('name', array('label' => 'nom', 'placeholder' => 'name')); ?> </br>
    <?php echo $this->Form->input('quantity', array('label' => 'quantity', 'placeholder' => 'quantity', 'value' => 1)); ?> </br>
    <?php echo $this->Form->end('ajouter'); ?>



</body>
</html>    