<?php

require_once "vendor/autoload.php";

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$file = new File();

$app->container->singleton('PDO', function()
{
    require_once "/lib/config.php";
    $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $DBH;
});

$DBH=$app->PDO;

$app->container->singleton('newFilesMapper', function() use ($DBH)
{
    return new FileMapper($DBH);
});

$app->get('/', function() use ($app, $file)
{
    $load = 0;
    $id = 0;
    
    $app->render('/upload.html', array(
        'file' => $file,
        'load' => $load,
        'id' => $id
    ));
});

$app->post('/', function() use ($app, $file)
{
    $mapper = $app->newFilesMapper;

    if ($_FILES['filename']['name']!="") {
        
        $data['type']    = $_FILES['filename']['type'];
        $data['name']    = $_FILES['filename']['name'];
        $data['size']    = $_FILES['filename']['size'];
        $data['comment'] = $_POST['comment'];
        
        do {
            $file->generateCode();
        } while ($mapper->iscodeUsed($file->getCode()));
                        
        $code = $file->getCode();
        $file->setFields($data);
        $id = $mapper->addFile($file);
        
        $name = $_FILES['filename']['name'];
        move_uploaded_file($_FILES['filename']['tmp_name'], "files/$code.$name");
        
        $load = 1;
    }
    
    $app->render('/upload.html', array(
        'file' => $file,
        'load' => $load,
        'id' => $id
    ));
});

$app->get('/list', function() use ($app, $file)
{
    $mapper = $app->newFilesMapper;
    $list     = $mapper->getAllFiles();
    $numfiles = count($list);
    
    $app->render('/list.html', array(
        'list' => $list,
        'numfiles' => $numfiles,
    ));
});

$app->get('/file/:id', function($id) use ($app, $file)
{
    $mapper  = $app->newFilesMapper;
    
    $file    = $mapper->getFilebyID($id);
    $filesize = round($file->getSize()/1048576, 3);
    
    $showimg = 0;
    $RegExp = "/^image/ui";
    if (preg_match($RegExp, $file->getType())) {
        $showimg = 1;
    }

    if (isset($_GET['submit'])) {
        

        $filename = $file->getName();
        $filetype = $file->getType();
        $code=$file->getCode();

        header("Content-Type: $filetype");
        header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\";");
        header("Content-Length: " . $file->getSize());
        readfile("files/$code.$filename");
        die();
    }
       
    $app->render('/file.html', array(
        'file' => $file,
        'showimg' => $showimg,
        'filesize' => $filesize
    ));
});



$app->run();