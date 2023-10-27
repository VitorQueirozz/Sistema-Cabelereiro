<?php 

    $user = 'root';
    $pass = '';
    $db = 'cortebrabo';
    $host = 'localhost';

    $conn = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);

?>