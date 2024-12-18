<?php 
include "connect.php";

session_start();

$errorMessage = " ";

if(isset($conn)){
    $db = "recipemanagementsystem";

    try{

        $conn->exec("USE $db");

    }catch(PDOException $e){
        $errorMessage = "Difficulties connecting to the Database: " . $e ->getMessage();
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
        if($username != null){
            $username = stripslashes($username);
        }
        $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
        //$password = !empty($_POST['password']);
        if(!empty($_POST['password'])){
            $password = $_POST['password'];

            $regexExpression = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_\-+=<>?{}[\]~])[A-Za-z\d!@#$%^&*()_\-+=<>?{}[\]~]{8,}$/";

            if(!preg_match($regexExpression, $password)){
                $_SESSION['weakPassword'] = "Password strength is weak.";
                header("Location: ../SignIn.php");
                exit();
            }
        }else{
            echo "password can't be empty.";
        }
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $phone = $_POST['phone'] ?? "999-999-999";
        $role = "client";

        //I want to check if email or username already exist

        $stmtsql =("SELECT COUNT(*) FROM Users WHERE email = :email OR username = :username");
        $smtmt = $conn->prepare($stmtsql);
        $smtmt->bindParam(':email' , $email, PDO::PARAM_STR);
        $smtmt->bindParam(':username' , $username, PDO::PARAM_STR);
        $smtmt->execute();

        $count = $smtmt->fetchColumn();
        if($count > 0){
            echo "Username or email already exists!";
        }else{
            try{
                
                $smtmt = $conn -> prepare("INSERT INTO Users (username, email, password, role, phone) VALUES (:username, :email, :password, :role, :phone) ");

                $smtmt->bindParam(':username', $username);
                $smtmt->bindParam(':email', $email);
                $smtmt->bindParam(':password', $password);
                $smtmt->bindParam(':phone', $phone);
                $smtmt->bindParam(':role', $role);
                $smtmt->execute();
                // echo "User registered successfully. ATE THAT UP!!!!!!!!!";

                header("Location: /LoginForm.php");
            }catch(PDOException $e){
                $errorMessage = "Database error: " . $e->getMessage();
                echo "$errorMessage";
            }
        }

    }else{
        $errorMessage = "Error connecting to the database.";
        echo "$errorMessage";
    }


}

?>
