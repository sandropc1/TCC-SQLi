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