<?php
$response = array(
				'request_type' => $request_type,
				'grid_data' => $grid_data
			);

echo $javascript->object($response);
?>
