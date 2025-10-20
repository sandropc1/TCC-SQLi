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

        if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

            $image = $_FILES["image"];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray   = ["image/jpeg", "image/jpg"];

            if (in_array($image["type"], $imageTypes)) {

                if (in_array($image["type"], $jpgArray)) {
                    $imgRes = imagecreatefromjpeg($image["tmp_name"]);
                    $ext = ".jpg";
                } else {
                    $imgRes = imagecreatefrompng($image["tmp_name"]);
                    $ext = ".png";
                }

                if (!$imgRes) {
                    $message->setMessage("Falha ao processar a imagem.", "error", "back");
                }

                // Gere um nome (use seu método do modelo)
                $imageName = $user->imageGenerateName() . $ext;

                // Garanta que a pasta exista e tenha permissão (chmod 775/777 conforme ambiente)
                $destPath = __DIR__ . "/img/users/" . $imageName;

                // Salva sempre em JPG de alta qualidade (ou use lógica por tipo)
                imagejpeg($imgRes, $destPath, 100);
                imagedestroy($imgRes);

                $userData->image = $imageName;

            } else {
                $message->setMessage("Tipo inválido de imagem, envie PNG ou JPG.", "error", "back");
            }
        }

        $userDAO->update($userData);

    }else if($type === "changepassword"){

        $password = filter_input(INPUT_POST, "password");      
        $confirmpassword = filter_input(INPUT_POST, "confirmpassword");   
        $id = filter_input(INPUT_POST, "id");   

        if($password == $confirmpassword){

            $user = new User();

            $finalPassword = $user->generatePassword($password);

            $user->password = $finalPassword;
            $user->id = $id;

            $userDAO->changePassword($user);

        }else{
        $message->setMessage("As senhas não coincidem", "error", "back");
        }

    }else {

        $message->setMessage("Informações inválidas!", "error", "index.php");

    }
?>