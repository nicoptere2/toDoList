
<!DOCTYPE html>
<html>
<head>
<style>
label

{

    display: block;

    width: 150px;


} 
</style>
</head>
<body>

<h3 align="center" >Inscription</h3>
<?php echo $this->Form->create('User'); ?>

  <?php echo $this->Form->input('username', array('label' => 'nom', 'placeholder' => 'username', 'value' => $d['username'])); ?> 
   <?php echo $this->Form->input('password', array('label' => 'mot de passe','placeholder' => 'Password')); ?> 
   <?php echo $this->Form->input('re_password', array('type'=>'password', 'label' => 'confirmation','placeholder' => 'retaper votre mot de passe')); ?> 
    <?php echo $this->Form->input('email', array('label' => 'email', 'placeholder' => 'email', 'value' => $d['email'])); ?>
   <?php echo $this->Form->input('age', array('label' => 'age','placeholder' => 'age', 'value' => $d['age'])); ?>
  <label> <?php echo $this->Form->end('s\'inscrire'); ?> </label>


<?php echo $this->Html->image("register_fb.jpg", array(
    "alt" => "Se connecter avec Facebook",
    'url' => array('action'=>'social_login', 'Facebook')
)); ?>

<?php echo $this->Html->image("login_google.jpg", array(
    "alt" => "Se connecter avec Google Plus",
    'url' => array('action'=>'social_login', 'Google')
)); ?>


</body>
</html>