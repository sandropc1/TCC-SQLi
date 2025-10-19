<?php

require_once("globals.php");
require_once("db.php");
require_once("models/Object.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("dao/ObjectDAO.php");


    $message = new Message($BASE_URL);
    $userDAO = new UserDAO($conn, $BASE_URL);    
    $objectDAO = new ObjectDAO($conn, $BASE_URL);

    $type = filter_input(INPUT_POST, "type");
    $id = filter_input(INPUT_POST, "id");

    $userData = $userDAO->verifyToken();
    
    if($type === "create"){


        $title = filter_input(INPUT_POST, "title");
        $description = filter_input(INPUT_POST, "description");

        $object = new Objects();

        if(!empty($title) && !empty($description)){

            $object->title = $title;
            $object->description = $description;
            $object->users_id = $userData->id;

            $objectDAO->create($object);

            $message->setMessage("Objeto adicionado com sucesso!", "success", "index.php");

        }else{
            $message->setMessage("Por favor, preencha todos os campos!", "error", "back");
        }

        print_r($_POST); print_r($_FILES); exit;

        $objectDAO->create($object);

    } else {
        $message->setMessage("Informações inválidas!", "error", "index.php");
    }