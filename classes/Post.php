<?php

class Post {
    private $filename;
    private $title;
    private $description;
    private $tags;


    /**
     * Get the value of filename
     */ 
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set the value of filename
     *
     * @return  self
     */ 
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of tags
     */ 
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set the value of tags
     *
     * @return  self
     */ 
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    //uploaden van post
    public function addPost() {
        //het pad om de geuploade afbeelding in op te slagen
        // $target = "image/" . basename($_FILES["uploadfile"]["name"]);
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];	
		$folder = "image/".date('YmdHis')."_".$filename; //.date('YmdHis')."_"

        //het type bestand uitlezen zodat we later non-images kunnen tegenhouden
        $imageFileType = strtolower(pathinfo($folder,PATHINFO_EXTENSION));

        //connectie naar db
        $conn = DB::getInstance();

        //alle data ophalen uit het ingestuurde formulier
        $filename = $this->getFilename();
        $title = $this->getTitle();
        $description = $this->getDescription();
        $tags = $this->getTags();

        if(!empty($imageFileType)){
            if($imageFileType === "jpg" || $imageFileType === "jpeg" || $imageFileType === "png") {
                $filename = $_FILES["uploadfile"]["name"];
            } else {
                throw new Exception("Please choose a valid png, jpg or jpeg file");
            }
        } else {
            throw new Exception("The image cannot be empty");
        }

        //opgehaalde data opslagen in databank
        $statement = $conn->prepare("insert into `post` (filename, title, description, tags) VALUES (:filename, :title, :description, :tags)");
        $statement->bindValue(":filename",$folder);
        $statement->bindValue(":title",$title);
        $statement->bindValue(":description",$description);
        $statement->bindValue(":tags",$tags);
        $statement->execute();

        //geuploade afbeelding in de images folder zetten
		if (move_uploaded_file($tempname, $folder)) {
			$msg = "Image uploaded successfully";
		}else{
			$msg = "Failed to upload image";
	    }
                
        if ($imageFileType === "jpg" || $imageFileType === "jpeg") {
            $image = imagecreatefromjpeg($folder);
        } else {
            $image = imagecreatefrompng($folder);
        }
                
        imagejpeg($image, $folder, 60);
                
        //de gebruiker terug naar de feed sturen
        header("location: index.php");
        
    }
}