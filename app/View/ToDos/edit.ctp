<?php   
echo '<table><form>';
    foreach($info as $champs)
	echo '<h3> Liste numéro - '.$champs['Todo']['id'].' </h3>';
	{
		echo '<tr height="50px">
		<td></td>
		<td><b> Id de la liste : </b></td>
		<td><input type="text" disabled="disabled" value="'.$champs['Todo']['id'].'" id="username"/></td>
		<td><button type="button" class="btn btn-default" >
				<span class="glyphicon glyphicon-pencil"></span>
			</button>
			</td>
	</tr>'; 
		echo '<tr height="50px">
		<td></td>
		<td><b> Nom de la liste : </b></td>
		<td><input type="text" value="'.$champs['Todo']['name'].'"/></td>
		<td><button type="button" class="btn btn-default">
				<span class="glyphicon glyphicon-pencil"></span>
			</button>
			</td>
	</tr>'; 
		echo '<tr height="50px">
		<td></td>
		<td><b> Fréquence : </b></td>
		<td><input type="text" value="'.$champs['Todo']['frequancy'].'"/></td>
		<td><button type="button" class="btn btn-default">
				<span class="glyphicon glyphicon-pencil"></span>
			</button>
			</td>
	</tr>'; 
		echo '<tr height="50px">
		<td width="10%"></td>
		<td width="30%"><b> Date d\'expiration:</b></td>
		<td align="left"><input type="text" value="'.$champs['Todo']['expirationDate'].'"/></td>
		<td align="left" width="10%"><button type="button" class="btn btn-default">
				<span class="glyphicon glyphicon-pencil"></span>
			</button>
			</td>
	</tr>'; 
	}
	
echo'</table>';
?>

<?php
	// Script du calendrier en JQuery
	echo $this->Html->css('jquery-ui');
	echo $this->Html->script('jquery');
	echo $this->Html->script('jquery-ui'); 
?>

<script type="text/javascript">
$(document).ready(function(){
            $("#datepicker_img img").click(function(){
                $("#datepicker").datepicker({
					dateFormat: 'yy-mm-dd',
					onSelect: function(dateText, inst){
						$('#select_date').val(dateText);
						$("#datepicker").datepicker("destroy");
						}
                });
            });
        });
</script>

<?php
	// Script du calendrier en JQuery
	echo $this->Html->css('jquery-ui');
	echo $this->Html->script('jquery');
	echo $this->Html->script('jquery-ui'); 
?>

<script type="text/javascript">
$(document).ready(function(){
            $("#datepicker_img img").click(function(){
                $("#datepicker").datepicker({
					dateFormat: 'yy-mm-dd',
					onSelect: function(dateText, inst){
						$('#select_date').val(dateText);
						$("#datepicker").datepicker("destroy");
						}
                });
            });
        });
</script>
