<?php 
class File
{
    
    protected $id;
    protected $type;
    protected $name;
    protected $size;
    protected $uploadtime;
    protected $comment;
    
    

    public function setFields($data)
    {
        foreach ($data as $key => $value) {
            $data[$key]=trim($value);
        }
        
        $this->type = $data['type'];
        $this->name = $data['name'];
        $this->size = $data['size'];
        $this->uploadtime = $data['uploadtime'];
        $this->comment = $data['comment'];
    }

    public function getID()
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getName()
    {
        return $this->name;
    }
    
    public function getSize()
    {
        return $this->size;
    }
    
    public function getUploadtime()
    {
        return $this->uploadtime;
    }

    public function getComment()
    {
        return $this->comment;
    }      

}
?>