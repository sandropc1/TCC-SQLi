<?php
require_once("globals.php");
require_once("db.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");

$message = new Message($BASE_URL);
$flassMessage = $message->getMessage();

if(!empty($flassMessage["msg"])) {
    $message->clearMessage();
}

$userDao = new UserDAO($conn, $BASE_URL);
$userData = $userDao->verifyToken(false);
