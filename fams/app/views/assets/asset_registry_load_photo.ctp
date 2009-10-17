<?php 
if($emp_photo != 'NO') { 
?>
	<img src="/img/employee_imgs/<?=$emp_photo?>" width="180px" height="180px" />
<?php 
} else {
?>
	<p style="margin-top:60px">No image available.</p>
<?php 
}
?>

