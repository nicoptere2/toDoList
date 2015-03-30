<h3>Inscription</h3>
<?php echo $this->Form->create('User'); ?>
    <?php echo $this->Form->input('username', array('label' => 'nom', 'placeholder' => 'username')); ?>
    <?php echo $this->Form->input('password', array('label' => 'mot de passe','placeholder' => 'Password')); ?>
    <?php echo $this->Form->input('re_password', array('type'=>'password', 'label' => 'confirmation','placeholder' => 'retaper votre mot de passe')); ?>
    <?php echo $this->Form->input('email', array('label' => 'email', 'placeholder' => 'email')); ?>
    <?php echo $this->Form->input('age', array('label' => 'age','placeholder' => 'age')); ?>
    <?php echo $this->Form->end('s\'inscrire'); ?>

<?php echo $this->Html->image("register_fb.jpg", array(
    "alt" => "Se connecter avec Facebook",
    'url' => array('action'=>'social_login', 'Facebook')
)); ?>

<?php echo $this->Html->image("login_google.jpg", array(
    "alt" => "Se connecter avec Google Plus",
    'url' => array('action'=>'social_login', 'Google')
)); ?>