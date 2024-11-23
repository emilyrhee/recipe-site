<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user'])) {
    $user_id = $_POST['userId'];

    // Validate user ID
    if (empty($user_id) || !is_numeric($user_id)) {
        echo "Invalid or missing user ID.";
        exit();
    } else {
      echo "test";
    }

    try {
        // Prepare the delete query
        $delete_query = "DELETE FROM Users WHERE id = :user_id";
        $stmt = $conn->prepare($delete_query);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            header("Location: ../Admin/Admin.php");
            exit();
        } else {
            $error = $stmt->errorInfo();
            echo "Failed to delete user. Error: " . $error[2];
        }
    } catch (PDOException $e) {
        // Log the error for debugging and show a generic message
        error_log("Error deleting user: " . $e->getMessage());
        echo "We weren't able to delete this user. Please try again later.";
    }
} else {
  echo "ugh";
}
?>
