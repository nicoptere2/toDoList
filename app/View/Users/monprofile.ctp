<?php   


echo '<table><form method="POST">';
    foreach($info as $champs)
	echo '<h3> Profil - '.$champs['User']['username'].' </h3>';
	{
		echo '<tr height="50px" width="500px">
		<td></td>
		<td><b> Pseudo : </b></td>
		<td><input type="text" disabled="disabled" value="'.$champs['User']['username'].'" id="username"/></td>
		<td><button type="button" class="btn btn-default" onclick="changeusername()" id="busername">
				<span class="glyphicon glyphicon-pencil"></span>
			</button>
			</td>
	</tr>'; 
		echo '<tr height="50px">
		<td></td>
		<td><b> Email : </b></td>
		<td><input type="text" disabled="disabled" value="'.$champs['User']['email'].'" id="email"/></td>
		<td><button type="button" class="btn btn-default" onclick="changeemail()" id="bemail"">
				<span class="glyphicon glyphicon-pencil"></span>
			</button>
			</td>
	</tr>'; 
		echo '<tr height="50px">
		<td width="50px"></td>
		<td width="100px"><b> Age : </b></td>
		<td align="left"><input type="text" disabled="disabled" value="'.$champs['User']['age'].'"/ id="age"></td>
		<td align="left" width="10%"><button type="button" class="btn btn-default" onclick="changeage()" id="bage" >
				<span class="glyphicon glyphicon-pencil"></span>
			</button>
			</td>
	</tr>'; 
	}
	
echo'</table><input type="submit" value="Enregistrer les modifications" style="display:none;" id="valid"></form>

<script>
var v = document.getElementById("valid");
function changeusername() {
    var champ = document.getElementById("username");
    champ.disabled=!champ.disabled;
	v.style.display="";
}
function changeemail() {
    var champ = document.getElementById("email");
    champ.disabled=!champ.disabled;
	v.style.display="";
}
function changeage() {
    var champ = document.getElementById("age");
    champ.disabled=!champ.disabled;
	v.style.display="";
}
</script>
';

?>


