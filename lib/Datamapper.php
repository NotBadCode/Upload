<?php
class DataMapper
{
    public $DBH;
    
    public function __construct(PDO $DBH)
    {
        $this->DBH = $DBH;
    }
    
    public function getFilebyID($id)
    {
        $STH = $this->DBH->prepare("SELECT * FROM files WHERE id=:id");
        $STH->bindparam(":id", $id);
        $STH->execute();
        $STH->setFetchMode(PDO::FETCH_CLASS, 'file');
        return $STH->fetch();
    }
    
    public function getAllFiles()
    {
        
        $STH = $this->DBH->prepare("SELECT * FROM files ORDER BY -id LIMIT 100");
        $STH->execute();
        $result = $STH->fetchAll(PDO::FETCH_CLASS, "file");
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
        
        $type    = $file->getType();
        $name    = $file->getName();
        $size    = $file->getSize();
        $comment = $file->getComment();
        
        
        $STH->execute();
        return $this->DBH->lastInsertId();
    }
    
}
?>