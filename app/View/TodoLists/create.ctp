<h3>Inscription</h3>

<?php echo $this->Form->create('TodoList'); ?>
    <?php echo $this->Form->input('name', array('label' => 'Nom', 'placeholder' => 'Nom de la liste')); ?>
	<?php echo $this->Form->input('frequency', array(
      'options' => array('Journalier', 'Hebdomadaire', 'Mensuel'),
      'empty' => '(choisissez)'));?>    
	<?php echo $this->Form->input('expirationDate', array('type'=>'Date', 'label' => 'Date','placeholder' => '')); ?>
<?php echo $this->Form->end('Créer une liste'); ?>
