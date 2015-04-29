<h3>Création d'une liste</h3>

<?php echo $this->Form->create('ToDo'); ?>
    <?php echo $this->Form->input('name', array('label' => 'Nom', 'placeholder' => 'Nom de la liste')); ?>
	<?php echo $this->Form->input('frequency', array(
      'options' => array('Journalier', 'Hebdomadaire', 'Mensuel'),
      'empty' => 'Aucune repetition'));?>    
	<?php echo $this->Form->input('expirationDate', array('type'=>'Date dexpiration', 'label' => 'Date','placeholder' => '')); ?>
<?php echo $this->Form->end('Creer une liste'); ?>