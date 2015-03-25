<div class="page-header">
	<h1>Vous devez choisir un pseudo</h1>
</div>

<?php echo $this->Form->create('User'); ?>
<?php echo $this->Form->input('username', array('label'=>'Pseudo')); ?>
<?php echo $this->Form->end('Envoyer'); ?>