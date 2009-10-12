<?php

$response = array(
				'status' => 'OK',
				'message' => 'No ERROR',
				'location_data' => $location_data ,
				'params' => $params 
			);

echo $javascript->object($response);

?>
