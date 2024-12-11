<?php
include __DIR__ . '/../handlers/connect.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Decode JSON payload
  $input = json_decode(file_get_contents('php://input'), true);

  // Validate session and input data
  if (isset($_SESSION['role'], $input['recipe_id'])) {
    $recipeId = intval($input['recipe_id']);
    $userId = $_SESSION['user_id'];
    $role = $_SESSION['role'];

    try {
      if ($role === 'chef' || $role === 'admin') {
        $sql = "DELETE FROM Recipe WHERE id = :recipe_id AND (chef_id = :chef_id OR :role = 'admin')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':recipe_id', $recipeId, PDO::PARAM_INT);
        $stmt->bindParam(':chef_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
          echo json_encode(['success' => true]);
        } else {
          echo json_encode(['success' => false, 'message' => 'Recipe not found or permission denied.']);
        }
      } else {
        echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
      }
    } catch (PDOException $e) {
      echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
  } else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
  }
} else {
  echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
