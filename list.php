<?php
	require_once "/lib/pdo.php";
	$mapper = new DataMapper($DBH);

	$list=$mapper->showAllFiles();


	$numfiles=count($list);

	include "templates/list.html";
?>