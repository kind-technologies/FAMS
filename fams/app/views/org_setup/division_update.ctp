<?php

$response = array(
				'status' => 'OK',
				'message' => 'No ERROR',
				'division_data' => $division_data ,
				'params' => $params 
			);

echo $javascript->object($response);

?>
