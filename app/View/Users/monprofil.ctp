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
	v.style.display="";
	var pseudo = prompt("Nouveau pseudo :", "");
    champ.disabled = "";
	if (pseudo.match(/^[a-z0-9]/)) {
		champ.value = pseudo;
	}
	else{
		changeusername();
	}
}
function changeemail() {
    var champ = document.getElementById("UserEmail");
	v.style.display="";
	var mail = prompt("Nouvel email :", "");
    champ.disabled = "";
	if(mail.match(/^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/)){
		champ.value = mail;
	}
	else{
		changeemail();
	}
}
function changeage() {
    var champ = document.getElementById("UserAge");
	v.style.display="";
	var annees = prompt("nouvel age :", "");
    champ.disabled = "";
	if((annees.match(/^-?[0-9]+$/))){
		champ.value = annees;
	}
	else{
		changeage();
	}	
}
</script>
';

?>
