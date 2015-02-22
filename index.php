<?php

	require_once "/lib/pdo.php";

	$mapper=new DataMapper($DBH);
	$file=new File();
	$load=0;
	if ($_FILES)
	{	

		$data['type']=$_FILES['filename']['type'];
		$data['name']=$_FILES['filename']['name'];
		$data['size']=$_FILES['filename']['size'];
		$data['comment']=$_POST['comment'];

		
		$file->setFields($data);
		$mapper->addFile($file);

		$name=$_FILES['filename']['name'];
		move_uploaded_file($_FILES['filename']['tmp_name'], "files/$name");

	    $id=$mapper->getLastID();
	    $load=1;

	}
	
	include "templates/upload.html";

?>

