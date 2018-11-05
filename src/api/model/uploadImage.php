<?php
if ($_FILES['fileUpload']['name']) {
	$destination = dirname(dirname(dirname(dirname(realpath('./uploadImage.php'))))).'\uploads\\';
	$time = strtotime(date('Y-m-d H:i:s')).'.'.pathinfo($_FILES['fileUpload']['name'])['extension'];
    $uploadedUrl = $destination.$time;
    move_uploaded_file($_FILES['fileUpload']['tmp_name'], $uploadedUrl);
}

echo $time;
exit;

?>