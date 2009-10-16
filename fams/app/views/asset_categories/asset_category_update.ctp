<?php

$response = array(
				'status' => 'OK',
				'message' => 'No ERROR',
				'asset_categories_data' => $asset_categories_data /* ,
				'params' => $params */
			);

echo $javascript->object($response);

?>
