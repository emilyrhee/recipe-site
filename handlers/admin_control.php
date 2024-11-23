<?php
include "connect.php";

function updateUserRole($conn, $user_id, $new_role) {
    $applicable_roles = ['client', 'chef', 'admin'];

    // Validate role
    if (!in_array($new_role, $applicable_roles)) {
        echo "Invalid role selected";
        exit();
    }

    try {
        $query = "UPDATE Users SET role = :role WHERE id = :user_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindParam(":role", $new_role);

        if ($stmt->execute()) {
            header("Location: ../Admin/Admin.php");
            exit();
        } else {
            echo "Failed to update role";
        }
    } catch (PDOException $e) {
        error_log("Error updating role: " . $e->getMessage());
        echo "We weren't able to update the role. Please try again later.";
    }
}

function deleteUser($conn, $user_id) {
    // Validate user ID
    if (empty($user_id) || !is_numeric($user_id)) {
        echo "Invalid or missing user ID.";
        exit();
    }

    try {
        $query = "DELETE FROM Users WHERE id = :user_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: ../Admin/Admin.php");
            exit();
        } else {
            $error = $stmt->errorInfo();
            echo "Failed to delete user. Error: " . $error[2];
        }
    } catch (PDOException $e) {
        error_log("Error deleting user: " . $e->getMessage());
        echo "We weren't able to delete the user. Please try again later.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_role'])) {
        $user_id = $_POST['userId'];
        $new_role = $_POST['role'];
        updateUserRole($conn, $user_id, $new_role);
    } elseif (isset($_POST['delete_user'])) {
        $user_id = $_POST['userId'];
        deleteUser($conn, $user_id);
    } else {
        echo "Invalid request.";
        exit();
    }
}
?>