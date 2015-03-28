<?php   
echo '
<h1 style="color:red" align="center"> Profil </h1>
<hr style="height:3;border-bottom: 5px;color:black; background-color:black; height:5px;" />	
'; 

echo '<table>';
    foreach($test as $champs)
	echo '<h3> Profil - '.$champs['User']['username'].' </h3>';
	{
		echo '<tr height="50px">
		<td></td>
		<td><b> Pseudo : </b></td>
		<td>'.$champs['User']['username'].' </td>
		<td>'.$this->Html->image("modif.jpg").'</td>
	</tr>'; 
		echo '<tr height="50px">
		<td></td>
		<td><b> Email : </b></td>
		<td>'.$champs['User']['email'].' </td>
		<td>'.$this->Html->image("modif.jpg").'</td>
	</tr>'; 
		echo '<tr height="50px">
		<td width="10%"></td>
		<td width="30%"><b> Age : </b></td>
		<td align="left">'.$champs['User']['age'].' </td>
		<td align="left" width="10%">'.$this->Html->image("modif.jpg").'</td>
	</tr>'; 
	}
	
echo'</table>';
?>
