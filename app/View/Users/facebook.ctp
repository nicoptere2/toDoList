<div class="page-header">
	<h1>Bonjour <?php echo $user['name']; ?>, <small>vous etes presque connecte, vous devez choisir un pseudo</small></h1>
</div>

<?php echo $this->Form->create('User'); ?>
<?php echo $this->Form->input('username', array('label'=>'Pseudo')); ?>
<?php echo $this->Form->end('Envoyer'); ?>