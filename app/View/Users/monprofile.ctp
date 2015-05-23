<?php   


echo '<table>';?><?php echo $this->Form->create('User', array('label' => false));
    foreach($info as $champs)
	echo '<h3> Profil - '.$champs['User']['username'].' </h3>';
	{
		echo '<tr height="50px" width="500px">
		<td></td>
		<td><b> Pseudo : </b></td>
		<td>';?><?php echo $this->Form->input('username', array('label' => '', 'default' => $champs['User']['username'], 'onclick' => 'changeusername();', 'disabled' => 'disabled')); ?> 
		<?php echo'</td>
		<td><div class="dropdown" align="right">
			<div class="dropup" align="right">
			<button type="button" class="btn btn-default"  id="busername" onclick="changeusername()">
				<span class="glyphicon glyphicon-pencil"></span>
			</button>
			</div>
			</div>
			</td>
	</tr>'; 
		echo '<tr height="50px">
		<td></td>
		<td><b> Email : </b></td>
		<td>';?><?php echo $this->Form->input('email', array('label' => '', 'default' => $champs['User']['email'], 'onclick' => 'changeemail();', 'disabled' => 'disabled')); ?>
		<?php echo'</td>
		<td><button type="button" class="btn btn-default" onclick="changeemail()" id="bemail"">
				<span class="glyphicon glyphicon-pencil"></span>
			</button>
			</td>
	</tr>'; 
		echo '<tr height="50px">
		<td width="50px"></td>
		<td width="100px"><b> Age : </b></td>
		<td align="left">';?><?php echo $this->Form->input('age', array('label' => '', 'default' => $champs['User']['age'], 'onclick' => 'changeage();', 'disabled' => 'disabled')); ?>
		<?php echo'</td>
		<td align="left" width="10%"><button type="button" class="btn btn-default" onclick="changeage()" id="bage" >
				<span class="glyphicon glyphicon-pencil"></span>
			</button>
			</td>
	</tr>'; 
	}
	
echo'</table>'; ?>

<?php echo '<div style="display:none;" id="submit">' ?>
<?php echo $this->Form->end('Enregistrer'); ?><?php echo '</div>' ?>

<?php
echo'
<script>
var v = document.getElementById("submit");
function changeusername() {
    var champ = document.getElementById("UserUsername");
    champ.disabled="";
	v.style.display="";
}
function changeemail() {
    var champ = document.getElementById("UserEmail");
    champ.disabled="";
	v.style.display="";
}
function changeage() {
    var champ = document.getElementById("UserAge");
    champ.disabled="";
	v.style.display="";
}
</script>
';

echo $this->Html->link('afficher les amis', array('controller' => 'Friends',
                                                  'action' => 'show_friends',
                                                  ));


?>
<br><br>
<center>
<?php echo $this->Html->link("Accueil", array('controller' => '/'), array( 'class' => 'button')); echo "		"; ?>
<?php echo $this->Html->link("Desinscription", array('controller' => 'users','action'=> 'delete'), array( 'class' => 'button')); echo "		"; ?>
<?php echo $this->Html->link("Retour", array('controller' => '/'), array( 'class' => 'button')) ?>
</center>




