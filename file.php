<?php

	require_once "/lib/pdo.php";

	require 'Slim/Slim.php'; 


	\Slim\Slim::registerAutoloader();
	$app = new \Slim\Slim(); 



	$mapper=new DataMapper($DBH);

	$app->post('/:id', function ($id) use ($mapper){ 
		
		$file=$mapper->showFilebyID($id);
		if (isset($_POST['submit']))
		{	
			$filename=$file->showName();
			$filesize=$file->showSize();
			$filetype=$file->showType();
			header("Content-Type: $filetype");
			header("Content-Disposition: attachment; filename=\"".basename($filename)."\";" );
			header("Content-Length: ".$filesize); 
			readfile("files/$filename");
		}
	}); 

	$app->get('/:id', function ($id) use ($mapper){ 
		
		$file=$mapper->showFilebyID($id);
		include "templates/file.html";
		
	}); 

	$app->run();
	

?>