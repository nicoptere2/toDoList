<h1 style="color:red" align="center"> Profil </h1>
<hr style="height:3;border-bottom: 5px;color:black; background-color:black; height:5px;" />	 
<table>
    <?php foreach ($info as $champs): ?>
	    	
		<h3> Profil - <?php echo $champs['User']['username'] ?> </h3>
		
			<tr height="50px">
			<td></td>
			<td><b> Pseudo : </b></td>
			<td><?php echo $champs['User']['username'] ?> </td>
			<td><?php echo $this->Html->image("modif.jpg")?></td>
		</tr> 
			<tr height="50px">
			<td></td>
			<td><b> Email : </b></td>
			<td><?php echo $champs['User']['email'] ?></td>
			<td><?php echo $this->Html->image("modif.jpg") ?></td>
		</tr>
			<tr height="50px">
			<td width="10%"></td>
			<td width="30%"><b> Age : </b></td>
			<td align="left"><?php echo $champs['User']['age'] ?> </td>
			<td align="left" width="10%"><?php echo $this->Html->image("modif.jpg") ?></td>
		</tr>
    <?php endforeach ?>
	
</table>
	
