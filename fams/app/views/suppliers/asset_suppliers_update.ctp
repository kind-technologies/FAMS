<?php

$response = array(
				'status' => 'OK',
				'message' => 'No ERROR',
				'suppliers_data' => $suppliers_data /* ,
				'params' => $params */
			);

echo $javascript->object($response);

?>
