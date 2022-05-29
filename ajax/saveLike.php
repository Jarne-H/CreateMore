<?php
    include_once(__DIR__ . "bootstrap.php");

    if (!empty($_POST)) {
        //$postId = $_POST['postId'];

        try {
            $like = new like();
            $like ->setPostId($_POST['postId']);
            $like ->setUsername($_POST['username']);
            $like ->saveLike(); //Active record
            //var_dump($_POST['postId']);
            //var_dump($like);
            $response = [ 

                "status" => "success",
                'body' => htmlspecialchars($like->getPostId()),
                'user' => htmlspecialchars($like->getUserName()),
                "message" => "Like was successful"
            ];
            
        }
        catch (Throwable $e) {


            $response = [ 

                "status" => "error",
                'body' => htmlspecialchars($like->getPostId()),
                'user' => htmlspecialchars($like->getUserName()),
                "message" => "Like was not successful"
            ];
        }
        echo json_encode($response);
    }