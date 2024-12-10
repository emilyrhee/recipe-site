<?php
include __DIR__ . '/../handlers/connect.php';

$categories = [];

try {
  $stmt = $conn->query("SELECT DISTINCT category FROM Recipe");
  $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
  echo "Error fetching data: " . $e->getMessage();
}
?>