<div class="span8">
	<div class="page-header">
		<h1>Connexion</h1>
	</div>
	
	<?php echo $this->Form->create('User'); ?>
		<?php echo $this->Form->input('username', array('label' => 'nom', 'placeholder' => 'username')); ?>
		<?php echo $this->Form->input('password', array('label' => 'mot de passe','placeholder' => 'Password')); ?>
	<?php echo $this->Form->end('se connecter'); ?>
</div>
	
<?php echo $this->Html->image("login_fb.jpg", array(
    "alt" => "Se connecter avec Facebook",
    'url' => array('action'=>'social_login', 'Facebook')
)); ?>
