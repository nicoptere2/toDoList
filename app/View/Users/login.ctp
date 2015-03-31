
<h1>Connection</h1><br>
<?php echo $this->Form->create('User'); ?>
<?php echo $this->Form->input('username', array('label' => 'nom', 'placeholder' => 'username')); ?>
<?php echo $this->Form->input('password', array('label' => 'mot de passe','placeholder' => 'Password')); ?>

<?php echo $this->Form->end('se connecter'); ?>
<?php echo $this->Html->link('Inscription', '/users/inscription') ?>
	
<?php echo $this->Html->image("login_fb.jpg", array(
    "alt" => "Se connecter avec Facebook",
    'url' => array('action'=>'social_login', 'Facebook')
)); ?>

<?php echo $this->Html->image("login_google.jpg", array(
    "alt" => "Se connecter avec Google Plus",
    'url' => array('action'=>'social_login', 'Google')
)); ?>