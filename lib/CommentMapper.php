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

    public function getCommentsByNode($node)
    {

        $STH = $this->DBH->prepare("SELECT * FROM comments WHERE fileid=:id and path LIKE (:node,'%') ORDER BY path");
        $STH->bindValue(":id", $id);
        $STH->bindValue(":node", $node);
        $STH->execute();
        return $STH->fetchAll(PDO::FETCH_CLASS, "comment");
    }

    public function deleteComment($node)
    {
        $STH = $this->DBH->prepare("DELETE FROM comments WHERE path LIKE (:node,'%')");
        $STH->execute();
    }

    public function editeComment(Comment $comment)
    {
        $STH = $this->DBH->prepare("UPDATE comments SET (text) 
            VALUES (:text) WHERE id:=:id");

        $STH->bindvalue(":id", $comment->getID());
        $STH->bindvalue(":text", $comment->getText());
            

        $STH->execute();
        $comment->setID($this->DBH->lastInsertId());
    }
    }
    
}