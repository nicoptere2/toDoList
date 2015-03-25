<div class="span8">
	<div class="page-header">
		<h1>Connexion</h1>
	</div>
	
	<?php echo $this->Form->create('User'); ?>
		<?php echo $this->Form->input('username', array('label' => 'nom', 'placeholder' => 'username')); ?>
		<?php echo $this->Form->input('password', array('label' => 'mot de passe','placeholder' => 'Password')); ?>
	<?php echo $this->Form->end('se connecter'); ?>
</div>
	
<div class="span8">
	<h1>Connexion avec Facebook</h1>
	<a href="<?php echo $this->Html->url(array('action'=>'facebook')); ?>" class="facebookConnect">Se connecter avec Facebook</a>
</div>