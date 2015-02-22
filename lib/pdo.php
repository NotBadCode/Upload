<?php

	require_once "/lib/login.php";
	require_once "/lib/file.php";

	$DBH=new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	class DataMapper
	{
	    public $DBH;

	    public function __construct(PDO $DBH)
	    {
	        $this->DBH=$DBH;
	    }
		
		public function searchStudents($request, $sort, $order)
	    {	        

	        $STH=$this->DBH->prepare("SELECT name, surname, groupnum, points FROM students WHERE name LIKE :request OR surname LIKE :request OR groupnum LIKE :request 
	        	ORDER BY $sort $order");
	        $STH->bindparam(":request", $request);

	        $request="%".$requests."%";

	        $STH->execute();
	        
	        $result = $STH->fetchAll(PDO::FETCH_CLASS, "profile");
	        return $result;
	        	        
	    }

	    public function emailUsed($email)
	    {
	        $STH=$this->DBH->prepare("SELECT * FROM students WHERE email=:email");
	        $STH->bindparam(":email", $email);
	        $STH->execute();
	        $STH->setFetchMode(PDO::FETCH_CLASS, 'profile');
	        return $STH->fetch();
	    }

	    public function showFilebyID($id)
	    {
	        $STH = $this->DBH->prepare("SELECT * FROM files WHERE id=:id");
	        $STH->bindparam(":id", $id);
	        $STH->execute();
	        $STH->setFetchMode(PDO::FETCH_CLASS, 'file');
        	return $STH->fetch();
	    }

	    public function showAllFiles()
	    {

		    $STH=$this->DBH->prepare("SELECT * FROM files ORDER BY -id LIMIT 100");
	        $STH->execute();
	        $result=$STH->fetchAll(PDO::FETCH_CLASS, "file");
	        return $result;
	    }

	    public function addFile(File $file)
	    {
	    	
	        $STH = $this->DBH->prepare("INSERT INTO files (type, name, size, comment) 
	        	VALUES (:type, :name, :size, :comment)");

	        $STH->bindparam(":type", $type);
	        $STH->bindparam(":name", $name);
	        $STH->bindparam(":size", $size);
	        $STH->bindparam(":comment", $comment);

	        $type=$file->showType();
	        $name=$file->showName();
	        $size=$file->showSize();
	        $comment=$file->showComment();

	        
	        $STH->execute();
	    }


	    public function getLastID()
	    {
	        
	        $STH=$this->DBH->query("SELECT id FROM files ORDER BY -id LIMIT 1");
	        $result=$STH->fetchColumn();
	        $id=$result;
	        return $id;
	    }



	    

	}
?>