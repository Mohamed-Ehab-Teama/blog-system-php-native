<?php

session_start();

$DBName = 'blog-system-php-native';
$serverName = 'localhost';
$DBUserName = 'root';
$DBPassword = '';

$connection = mysqli_connect($serverName, $DBUserName, $DBPassword, $DBName);