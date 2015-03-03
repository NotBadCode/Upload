<?php

require_once "vendor/autoload.php";

\Slim\Slim::registerAutoloader();
$twigView = new \Slim\Views\Twig();

$app = new \Slim\Slim(array(
    'dbhost' => 'localhost', 
    'dbuser' => 'root', 
    'dbpassword' => '', 
    'dbname' => 'files', 
    'view' => $twigView,
    'templates.path' => 'templates/'
));

$view = $app->view();
$view->parserOptions = array(
    'debug' => true,
    'cache' => dirname(__FILE__) . '/tmp/cache',
    'auto_reload' => true
);

$view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
);

$file = new File();
$comment = new Comment();

$app->container->singleton('newFilesMapper', function() use ($app)
{
    $DBC = 'mysql:host=' . $app->config('dbhost') . ';dbname=' . $app->config('dbname');
    $DBH = new PDO($DBC, $app->config('dbuser'), $app->config('dbpassword'));
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
    $i = 0;

    if ($_FILES['filename']['name']!="") {
        
        $data['type']    = $_FILES['filename']['type'];
        $data['name']    = $_FILES['filename']['name'];
        $data['size']    = $_FILES['filename']['size'];
        $data['comment'] = $_POST['comment'];

        $numfiles = count($mapper->getAllFiles()); //oi kak ne effektivnoooo!
        do {
            $file->generateCode();
            $i++;
            if($i>$numfiles){
                echo "Ошибка загрузки";
                die();
            }
        } while ($mapper->iscodeUsed($file->getCode()));
                        
        $code = $file->getCode();
        $file->setFields($data);
        $mapper->addFile($file);
        $id = $file->getID();
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
    $mapper   = $app->newFilesMapper;
    $file     = $mapper->getFilebyID($id);
       
    if(!$file){
        $app->notFound();
        die();
    }
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

        // header("X-SendFile: files/$code.$filename");
        header("Content-Type: $filetype");
        header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\";");
        header("Content-Length: " . $file->getSize());
        readfile("files/$code.$filename");

        die();
    }
       
    $comments = $mapper->getAllComments($id);

    $app->render('/file.html', array(
        'file' => $file,
        'showimg' => $showimg,
        'filesize' => $filesize,
        'comments' => $comments
    ));
});

$app->post('/file/:id', function($id) use ($app, $file, $comment)
{
    $mapper   = $app->newFilesMapper;  
    $file     = $mapper->getFilebyID($id);
       
    if(!$file){
        $app->notFound();
        die();
    }
    $filesize = round($file->getSize()/1048576, 3);
    
    $showimg = 0;
    $RegExp = "/^image/ui";
    if (preg_match($RegExp, $file->getType())) {
        $showimg = 1;
    }

    if (isset($_POST['submitcom']) && $_POST['text']!="") {
        
        $data['fileid']  = $id;
        $data['name']  = ($_POST['name']=="" ? "Аноним" : $_POST['name']);
        $data['text']  = $_POST['text'];
        $data['path']  = ($_POST['path']=="" ? 1 : $_POST['path']);;

        $comment->setFields($data);
        $mapper->addComment($comment);

    }
       
    $comments = $mapper->getAllComments($id);

    $app->render('/file.html', array(
        'file' => $file,
        'showimg' => $showimg,
        'filesize' => $filesize,
        'comments' => $comments
    ));
});



$app->run();