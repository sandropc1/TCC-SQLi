<?php
require_once("globals.php");
require_once("db.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");

$userDao = new UserDAO($conn, $BASE_URL);
$userDao->destroyToken();
