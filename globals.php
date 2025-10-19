<?php
session_start();
$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI'] . '?') . '/';
$BASE_URL = str_replace('index.php', '', $BASE_URL);
$BASE_URL = rtrim($BASE_URL, '/') . '/';