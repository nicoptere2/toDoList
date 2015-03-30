
<h1>Connection</h1><br>
<?php echo $this->Form->create('User'); ?>
<?php echo $this->Form->input('username', array('label' => 'nom', 'placeholder' => 'username')); ?>
<?php echo $this->Form->input('password', array('label' => 'mot de passe','placeholder' => 'Password')); ?>

<?php echo $this->Form->end('se connecter'); ?>