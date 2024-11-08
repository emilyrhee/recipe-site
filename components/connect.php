<?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    try{
        $conn = new PDO("mysql:host=$servername", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $conn->exec("USE recipemanagementsystem");
        $stmt = $conn->prepare("SELECT title FROM Recipe WHERE id = :id");
        $stmt->bindParam(':id', $recipeId);
        $recipeId = 1; // this is hard-coded rn, needs to be changed later.
        $stmt->execute();
        $recipe = $stmt->fetch(PDO::FETCH_ASSOC);

    }catch(PDOException $e){
        echo "Connection to database have failed " . $e->getMessage() . "<br>";
        exit();
    }
?>