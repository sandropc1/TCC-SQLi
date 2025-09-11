<?php
require_once("globals.php");
require_once("db.php");
require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");

    $message = new Message($BASE_URL);

    $userDAO = new UserDAO($conn, $BASE_URL);

    //Resgata o tipo do form
    $type = filter_input(INPUT_POST, "type");


    if($type === "update") {

        $userData = $userDAO->verifyToken();

        $name = filter_input(INPUT_POST, "name");      
        $lastname = filter_input(INPUT_POST, "lastname");      
        $email = filter_input(INPUT_POST, "email");      
        $bio = filter_input(INPUT_POST, "bio");

        $user = new User();

        $userData->name = $name;
        $userData->lastname = $lastname;
        $userData->email = $email;
        $userData->bio = $bio;

        if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])){
            
            $image = $_FILES["image"];
            $imageTypes = ["image/jpg", "image/jpeg","image/png"];
            $jpgArray = ["image/jpg", "image/jpeg"];

            //checagem do tipo da imagem
            if(in_array($image["type"], $imageTypes)){

                //checar se é jpg
                if(in_array($image,$jpgArray)){

                    $imageFile = imagecreatefromjpeg($image["tmp_name"]);

                //imagem é png
                } else {

                    $imageFile = imagecreatefrompng($image["tmp_name"]);
                }

                $imagename = $user->imageGenerateName();


            }else{

                $message->setMessage("Extensão de imagem não suportada.","error","back");

            }
        }

        $userDAO->update($userData);

    }else if($type === "changepassword"){

    }else {

        $message-setMessage("Informações inválidas!", "error", "index.php");

    }
?>