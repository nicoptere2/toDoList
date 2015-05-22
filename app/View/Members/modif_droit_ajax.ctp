<?php
	if(isset($error))
		echo $error;
?>

<?php 
	if(isset($users))
		echo json_encode($users);

?>