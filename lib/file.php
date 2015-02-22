<?php 

	class File{
		
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

        public function showID()
        {
            return $this->id;
        }

        public function showType()
        {
            return $this->type;
        }

        public function showName()
        {
            return $this->name;
        }
        
        public function showSize()
        {
            return $this->size;
        }
        
        public function showUploadtime()
        {
            return $this->uploadtime;
        }

        public function showComment()
        {
            return $this->comment;
        }       
    
	}
?>