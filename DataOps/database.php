<?php
// Need section that creates and populates database if not already present.
//  Use .txt file and a set of functions? Needs yet to be determined. 
    global $db;
    $dsn = 'mysql:host=localhost;dbname=StudyTime';
    $username = 'root';
    $password = 'Jesus4mE';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>