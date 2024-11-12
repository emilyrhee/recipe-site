<?php
include "connect.php";

session_start();

$error = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if(isset($conn)){
        $db = "recipemanagementsystem";

        try{

            $conn->exec("USE $db");

            $stmtsql = "SELECT id, username,  email, password, role FROM Users WHERE email = :email";
            $stmt = $conn->prepare($stmtsql);
            $stmt->bindParam(':email' , $email, PDO::PARAM_STR);
            $stmt->execute();
            // echo "Connected";

            if($stmt->rowCount() > 0){
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                // we need to incorprate a way for hashes so we we compare the pswd to the hashes one
                if($user && password_verify($password, $user['password'])){
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    
                    header("Location: ../index.php");

                    exit();
                }else{
                    $error = "Invalid email or password";
                }
            }else{
                $error = "Invalid email or password";
            }
        }catch(PDOException $e){
            $error = "Database error: ". $e->getMessage();
        }
    }
}else{
    $error = "Database Unavalaible: ";
}

if (!empty($error)) {
    $_SESSION['error'] = $error;
    header("Location: ../LoginForm.php"); // Redirect to the login page to show the error
    exit();
}
?>