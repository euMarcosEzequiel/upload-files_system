<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'upload_files';

    $conn = new mysqli($host, $user, $password, $dbname);

    header('Location: index.php');
?>