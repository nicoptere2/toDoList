<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('style');


		echo $this->fetch('meta');

		echo $this->fetch('css');

		//echo $this->Js->set('baseUrl',$this->request->base);
		?>
			<script type="text/javascript">
				var baseUrl = '<?php echo $this->request->base ?>'
			</script>
			<!--<script type="text/javascript">var userId = '<?php //echo (AuthComponent::user('id') != null)? AuthComponent::user('id') : ''  ?>'</script>-->
		<?php

		echo $this->Html->script('jquery');

		echo $this->Html->script('angular');
		
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container" class="container">
		<div id="header">

			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<p class="navbar-text title"><?php echo $title_for_layout ?></p>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse allnavbar" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right menu">
                                                    <?php if (AuthComponent::user('id') != null): ?>
							<li class="dropdown">          
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="navbar-right glyphicon glyphicon-menu-hamburger"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><?php echo $this->Html->link('Accueil', '/') ?></li>
									<li><?php echo $this->Html->link('Profil', '/users/monprofile') ?></li>
									<li class="divider"></li>
									<li><?php echo $this->Html->link('Deconnexion', '/users/logout') ?></li>
								</ul>
							</li>
                                                    <?php else: ?>
                                                        <li><?php echo $this->Html->link('Connexion', '/users/login') ?></li>
                                                    <?php endif ?>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>



		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>

			<?php echo $this->fetch('test'); ?>
			
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php echo $this->Html->script('jquery') ?>
	<?php echo $this->Html->script('bootstrap') ?>
</body>
</html>
