<?php
session_start();
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'];

$root = str_replace(['/views', '/templates'], '', dirname($_SERVER['SCRIPT_NAME']));
$root = rtrim($root, '/\\') . '/';

$BASE_URL = $protocol . $host . $root;