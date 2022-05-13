<?php

class Post {
    private $id;
    private $filename;
    private $title;
    private $description;
    private $tags;

    
    //setters en getters
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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

    //ulpoad post
    public static function uploadPost($title, $description, $tags,) {

        $filename = $_FILES["uploadfile"]["name"];
	    $tempname = $_FILES["uploadfile"]["tmp_name"];	
		$folder = "image/".$filename;

        // connectie met db
        $conn = DB::getInstance();


        //query
        $statement = $conn->prepare("INSERT INTO `post` (filename, title, description, tags) VALUES (:filename, :title, :description, :tags)");
        $statement->bindValue(":filename", $filename);
        $statement->bindValue(":title", $title);
        $statement->bindValue(":description", $description);
        $statement->bindValue(":tags", $tags);

		// Execute query
		// mysqli_query($conn, $sql);
        $statement->execute();

        // Now let's move the uploaded image into the folder: image
		if (move_uploaded_file($tempname, $folder)) {
			// $msg = "Image uploaded successfully";
            echo "yep";
		}else{
			// $msg = "Failed to upload image";
            echo "nope";
	}

        // $fileName = $_SESSION["user"] . "_" . date('YmdHis') . ".jpg";
        // $targetDir = "uploads/posts/";
        // $targetFile = $targetDir . basename($fileName);
        //$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        // if ($_FILES["postImage"]["size"] > 700000) {
        //     throw new Exception("File is too large, it can't be bigger than 700KB");
        // } else {
        //     move_uploaded_file($_FILES["postImage"]["tmp_name"], $targetFile);

        //     $conn = Db::getConnection();
        //     $statement = $conn->prepare("INSERT INTO posts (user_id, image, description, filter, location) VALUES (:userId, :image, :description, :filter, :location)");
        //     $statement->bindValue(":userId", User::fetchUserByUsername($_SESSION["user"])->getId());
        //     $statement->bindValue(":image", $fileName);
        //     $statement->bindValue(":description",$description);
        //     $statement->bindValue(":filter", $filter);
        //     $statement->bindValue(":location", Post::findLocation($longitude, $latitude));
        //     $statement->execute();

        //     print_r(Post::findLocation($longitude, $latitude));
        }
    }