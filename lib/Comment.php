<?php 
class Comment
{
    
    protected $id;
    protected $number;
    protected $path;
    protected $fileid;
    protected $name;
    protected $text;
    protected $time;
    
    public function setFields($data)
    {
        foreach ($data as $key => $value) {
            $data[$key]=trim($value);
        }
        
        $this->fileid = $data['fileid'];
        $this->name = $data['name'];
        $this->text = $data['text'];
        $this->path = $data['path'];
    }

    public function setID($id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getPath()
    {
        return $this->path;
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function getText()
    {
        return $this->text;
    }
    
    public function getTime()
    {
        return $this->time;
    }

    public function getFileID()
    {
        return $this->fileid;
    }
     
}