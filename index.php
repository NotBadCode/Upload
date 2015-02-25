<?php
require_once "/lib/File.php";
require_once "/lib/pdo.php";
require_once "/lib/Datamapper.php";
require 'Slim/Slim.php';


\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->container->singleton('newDM', function() use ($DBH)
{
    return new DataMapper($DBH);
});

$app->container->singleton('newFile', function()
{
    return new File();
});

$app->get('/', function() use ($app)
{
    $load = 0;
    
    $app->render('/header.html');
    $app->render('/upload.html', array(
        'load' => $load
    ));
    $app->render('/footer.html');
});

$app->post('/', function() use ($app)
{
    $mapper = $app->newDM;
    $file   = $app->newFile;

    if ($_FILES['filename']['name']!="") {
        
        $data['type']    = $_FILES['filename']['type'];
        $data['name']    = $_FILES['filename']['name'];
        $data['size']    = $_FILES['filename']['size'];
        $data['comment'] = $_POST['comment'];
        
        $file->generateCode();
            while ($mapper->iscodeUsed($file->getCode())) {
                $file->generateCode();
        }
        $code=$file->getCode();
        $file->setFields($data);
        $id = $mapper->addFile($file);
        
        $name = $_FILES['filename']['name'];
        move_uploaded_file($_FILES['filename']['tmp_name'], "files/$code.$name");
        
        $load = 1;
    }
    
    $app->render('/header.html');
    $app->render('/upload.html', array(
        'file' => $file,
        'load' => $load,
        'id' => $id
    ));
    $app->render('/footer.html');
});

$app->get('/list', function() use ($app)
{
    $mapper = $app->newDM;
    $list     = $mapper->getAllFiles();
    $numfiles = count($list);
    
    $app->render('/header.html');
    $app->render('/list.html', array(
        'list' => $list,
        'numfiles' => $numfiles,
    ));
    $app->render('/footer.html');
});

$app->get('/file/:id', function($id) use ($app)
{
    $mapper  = $app->newDM;
    $file    = $app->newFile;
    
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
    }
    
    

    $app->render('/header.html');
    $app->render('/file.html', array(
        'file' => $file,
        'showimg' => $showimg,
        'filesize' => $filesize
    ));
    $app->render('/footer.html');
});



$app->run();
?>