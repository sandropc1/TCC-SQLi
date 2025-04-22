<?php
require_once("globals.php");
require_once("db.php");
require_once("models/User.php");
require_once("models/Message.php");
require_once("DAO/UserDAO.php");

    $message = new Message($BASE_URL);

    $userDAO = new UserDAO($conn, $BASE_URL);

    //Resgata o tipo do form
    $type = filter_input(INPUT_POST, "type");


    //Verificação do tipo de form
    if($type === "register"){

        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

        //Verificação de dados minimos
        if($name && $lastname && $email && $password){

            if($password === $confirmpassword){

                if($userDAO->findByEmail($email) === false){

                    $user = new User();

                    $userToken = $user->generateToken();
                    $finalPassword =  $user->generatePassword($password);
                    
                    $user->name = $name;
                    $user->lastname = $lastname;
                    $user->email = $email;
                    $user->password = $finalPassword;
                    $user->token = $userToken;

                    $auth = true;

                    $userDAO->create($user, $auth);

                }else{

                    $message->setMessage("E-mail inválido.","error","back");

                }

            }else{

                $message->setMessage("As senhas não são iguais.","error","back");

            }
            
        }else{

            $message->setMessage("Por favor, preencha todos os campos.","error","back");

        }
    
    }else if($type === "login"){

        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
    
        // Tenta autenticar usuário
        if($userDAO->authenticateUser($email, $password)) {
    
          $message->setMessage("Seja bem-vindo!", "success", "editprofile.php");
    
        // Redireciona o usuário, caso não conseguir autenticar
        } else {
    
          $message->setMessage("Usuário e/ou senha incorretos.", "error", "back");
    
        }
    
      } else {
    
        $message->setMessage("Informações inválidas!", "error", "index.php");
    
      }