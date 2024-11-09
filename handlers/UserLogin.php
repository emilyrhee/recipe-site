<?php
include "../components/connect.php";

session_start();

$error = " ";

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
            echo "Connected";

            if($stmt->rowCount() > 0){
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                // we need to incorprate a way for hashes so we we compare the pswd to the hashes one
                if($user && password_verify($password, $user['password'])){
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    
                    header("Location: /index.php");

                    exit();
                }else{
                    $error = "Invalid password or username";
                }
            }else{
                $error = "Invalid username or password2";
            }
        }catch(PDOException $e){
            $error = "Database error: ". $e->getMessage();
        }
    }
}else{
    $error = "Database Unavalaible: ";
}
?>