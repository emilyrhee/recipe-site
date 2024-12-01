<?php
session_start();
$error_message = "";
include "../handlers/connect.php";
// this  need to work.....AHHHHHH
if (isset($conn)) {
    $db = "recipemanagementsystem";

    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        //$searchQuery = filter_input(INPUT_POST, 'query');
        //just for the recipe filter when user typing in the search bar
        $querying = " SELECT r.id, 
                r.title, 
                r.category, 
                r.image_url, 
                u.username FROM Recipe r
              JOIN Users u ON r.chef_id = u.id";

        if (!empty($_POST['query'])) {
            $searchTerm = '%' . $_POST['query'] . '%';
            $querying .= " WHERE r.title LIKE :searchTerm";
        }
    }
    try {
        $stmt = $conn->prepare($querying);

        if (!empty($_POST['query'])) {
            $stmt->bindParam(":searchTerm", $searchTerm, PDO::PARAM_STR);
        }
        $stmt->execute();
        $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "YEAH!!!!!!!!!!!!!!";

        foreach($recipes as $recipe){
            $imageUrl = !empty($recipe['image_url']) ? htmlspecialchars($recipe['image_url']) : 'default-image.jpg';
            $title = htmlspecialchars($recipe['title']);
            $chef_name = htmlspecialchars($recipe['username']);

            echo "  <div class='col-sm-6 col-md-5 col-lg-4'>
                    <div class='card h-100'>
                        <a href='../recipe-template.php?id={$recipe['id']}'>
                            <img src='{$imageUrl}' class='card-img-top' alt='{$title}' style='object-fit: cover; height: 200px;'>
                        </a>
                        <div class='card-body position-relative'>
                            <a href='../recipe-template.php?id={$recipe['id']}' class='link-dark'>
                                <h5 class='card-title'>{$title}</h5>
                            </a>
                            <p class='card-text'>By {$chef_name}</p>
                        </div>
                    </div>
                </div>";
        }
    } catch (PDOException $e) {
        $error_message = "Couldn't connect to the database " . $e->getMessage();
        echo $error_message;
    }
}
