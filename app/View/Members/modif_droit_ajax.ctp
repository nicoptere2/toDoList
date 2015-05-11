<?php
	if(isset($error))
		echo $error;
?>

<?php 
	if(isset($users))
		echo htmlentities(json_encode($users))

?>