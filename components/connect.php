<?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    try{
        $conn = new PDO("mysql:host=$servername", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("USE recipemanagementsystem");
    }catch(PDOException $e){
        echo "Connection to database have failed " . $e->getMessage() . "<br>";
        exit();
    }
?>