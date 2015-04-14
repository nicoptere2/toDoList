<h3>Ajout d'un élément</h3>
<?php echo $this->Form->create('Task'); ?>
    <?php echo $this->Form->input('name', array('label' => 'nom', 'placeholder' => 'name')); ?>
    <?php echo $this->Form->input('quantity', array('label' => 'quantity', 'placeholder' => 'quantity', 'value' => 1)); ?>
    <?php echo $this->Form->end('ajouter'); ?>