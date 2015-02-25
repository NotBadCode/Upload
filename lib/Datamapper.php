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
        $STH->bindvalue(":id", $id);
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
        
        $STH = $this->DBH->prepare("INSERT INTO files (type, name, size, comment, code) 
            VALUES (:type, :name, :size, :comment, :code)");
        
        $STH->bindvalue(":type", $file->getType());
        $STH->bindvalue(":name", $file->getName());
        $STH->bindvalue(":size", $file->getSize());
        $STH->bindvalue(":comment", $file->getComment());
        $STH->bindvalue(":code", $file->getCode());
        

        
        $STH->execute();
        return $this->DBH->lastInsertId();
    }

    public function iscodeUsed($code)
    {
        $STH = $this->DBH->prepare("SELECT * FROM files WHERE code=:code");
        $STH->bindValue(":code", $code);
        $STH->execute();
        $STH->setFetchMode(PDO::FETCH_CLASS, 'profile');
        return $STH->fetch();
    }
    
}
?>