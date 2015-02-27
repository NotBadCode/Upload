<?php 
class File
{
    
    protected $id;
    protected $type;
    protected $name;
    protected $size;
    protected $uploadtime;
    protected $comment;
    protected $code;
    
    

    public function setFields($data)
    {
        foreach ($data as $key => $value) {
            $data[$key]=trim($value);
        }
        
        $this->type = $data['type'];
        $this->name = $data['name'];
        $this->size = $data['size'];
        $this->comment = $data['comment'];
    }

    public function generateCode()
    {
        $string = "abcdefghijklmnopqrstuvwxyz1234567890";
        $newcode = "";
        $length = 36;
        for ($i = 0; $i <= 31; $i++) {
            $newcode .= $string[mt_rand(0, 35)];
        }
        
        $this->code = $newcode;
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

    public function getCode()
    {
        return $this->code;
    }     

}
?>