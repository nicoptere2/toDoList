$this->Html->scriptStart(array('inline'=>false)); ?>
    document.getElementById('switchActif').onclick = function(){ 
        document.getElementById('usern').disabled = !document.getElementById('usern').disabled; 
    };
<?php $this->Html->scriptEnd(); ?>

<?php   

echo '<table><form>';
    foreach($test as $champs)
	echo '<h3> Profil - '.$champs['User']['username'].' </h3>';
	{
		echo '<tr height="50px">
		<td></td>
		<td><b> Pseudo : </b></td>
		<td><form action="#"><input class="edit" value="'.$champs['User']['username'].'" /></form></td>
		<td><button type="button" class="btn btn-default" id="switchActif">
				<span class="glyphicon glyphicon-pencil"></span>
			</button>
			</td>
	</tr>'; 
		echo '<tr height="50px">
		<td></td>
		<td><b> Email : </b></td>
		<td><input type="text" disabled="disabled"/>'.$champs['User']['email'].' </td>
		<td><button type="button" class="btn btn-default">
				<span class="glyphicon glyphicon-pencil"></span>
			</button>
			</td>
	</tr>'; 
		echo '<tr height="50px">
		<td width="10%"></td>
		<td width="30%"><b> Age : </b></td>
		<td align="left"><input type="text" disabled="disabled"/>'.$champs['User']['age'].' </td>
		<td align="left" width="10%"><button type="button" class="btn btn-default">
				<span class="glyphicon glyphicon-pencil"></span>
			</button>
			</td>
	</tr>'; 
	}
	
echo'</table>';


