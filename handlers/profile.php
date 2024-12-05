<?php 
include "../handlers/connect.php";

session_start();
$error_message = "";

if(!isset($_SESSION['user_id'])){
    header("Location: ../index.php");
    exit();
}

if(isset($conn)){
    $db = "recipemanagementsystem";
    $user_id = $_SESSION['user_id']; // collect user_id 
    try{
        $pfp = "SELECT username, email, password, role, phone FROM Users WHERE id = :user_id";
        $pfp_statement = $conn->prepare($pfp);
        $pfp_statement->bindParam(':user_id', $user_id);
        $pfp_statement->execute();

        //check user actually exist 
        $user_checker = $pfp_statement->fetch(PDO::FETCH_ASSOC);
        if(!$user_checker){
            echo "User doesn't exist";
        }
    }catch(PDOException $e){
        $error_message = "Have error connecting to the database " . $e->getMessage();
    }
}
?>
