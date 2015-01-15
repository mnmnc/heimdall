<?php

	$t = shell_exec('./test.sh');
	//header('Content-Type: application/json');
	echo json_encode($t);
?>
