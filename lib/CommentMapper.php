<?php
class CommentMapper
{
    public $DBH;
    
    public function __construct(PDO $DBH)
    {
        $this->DBH = $DBH;
    }
    
    public function getAllComments($id)
    {

        $STH = $this->DBH->prepare("SELECT * FROM comments WHERE fileid=:id ORDER BY path");
        $STH->bindValue(":id", $id);
        $STH->execute();
        return $STH->fetchAll(PDO::FETCH_CLASS, "comment");
    }

    public function addComment(Comment $comment)
    {
        $STH = $this->DBH->prepare("SELECT COUNT(*) FROM comments WHERE path LIKE :path");

        if($comment->getPath()==""){
            $STH->bindvalue(":path", '_');
        }
        else{
            $STH->bindvalue(":path", $comment->getPath().'._');
        }

        $STH->execute();
        $num = $STH->fetchColumn();
        $num++;



        $STH = $this->DBH->prepare("INSERT INTO comments (number, path, name, fileid, text) 
            VALUES (:number, :path, :name, :fileid, :text)");
        
        $STH->bindvalue(":number", $num);
        
        if($comment->getPath()==""){
            $STH->bindvalue(":path", "$num");
        }
        else{
            $STH->bindvalue(":path", $comment->getPath().".$num");
        }

        $STH->bindvalue(":name", $comment->getName());
        $STH->bindvalue(":fileid", $comment->getFileID());
        $STH->bindvalue(":text", $comment->getText());
            

        $STH->execute();
        $comment->setID($this->DBH->lastInsertId());
    }
    
}