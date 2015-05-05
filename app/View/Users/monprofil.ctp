<?php   


echo '<table><form>';
    foreach($info as $champs)
	echo '<h3> Profil - '.$champs['User']['username'].' </h3>';
	{
		echo '<tr height="50px" width="500px">
		<td></td>
		<td><b> Pseudo : </b></td>
		<td><input type="text" disabled="disabled" value="'.$champs['User']['username'].'" id="username"/></td>
		<td><button type="button" class="btn btn-default" >
				<span class="glyphicon glyphicon-pencil"></span>
			</button>
			</td>
	</tr>'; 
		echo '<tr height="50px">
		<td></td>
		<td><b> Email : </b></td>
		<td><input type="text" disabled="disabled" value="'.$champs['User']['email'].'"/></td>
		<td><button type="button" class="btn btn-default">
				<span class="glyphicon glyphicon-pencil"></span>
			</button>
			</td>
	</tr>'; 
		echo '<tr height="50px">
		<td width="50px"></td>
		<td width="100px"><b> Age : </b></td>
		<td align="left"><input type="text" disabled="disabled" value="'.$champs['User']['age'].'"/></td>
		<td align="left" width="10%"><button type="button" class="btn btn-default">
				<span class="glyphicon glyphicon-pencil"></span>
			</button>
			</td>
	</tr>'; 
	}
	
echo'</table>';

?>
