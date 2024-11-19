<?php 
include "../handlers/connect.php";

session_start();
$errorMessage = "";
$recipe_data = [];

if(isset($conn)){
    $db = "recipemanagementsystem";

    try{
        $querying = " SELECT title FROM Recipe";
        if(isset($_POST['searching']) && !empty($_POST['searching'])){
            $querying .= " WHERE title LIKE :query";
        }
        $qstate = $conn->prepare($querying);
        if(isset($_POST['searching']) && !empty($_POST['searching'])){
            $query = ('%' . $_POST['searching'] . '%');

            $qstate->bindValue(':query', $query, PDO::PARAM_STR);
        }
        $qstate->execute();
        $recipe_data  = $qstate->fetchAll(PDO::FETCH_ASSOC);

    }catch(PDOException $e){
        $errorMessage = "error connecting to database " . $e->getMessage();
        echo $errorMessage;
        exit;
    }

    if(!empty($recipe_data)){
        foreach($recipe_data as $data){
            echo '<p>' . htmlspecialchars($data['title']) . '</p>';
        }
    }else{
        echo "<p> No result found </p>";
    }
}
?>