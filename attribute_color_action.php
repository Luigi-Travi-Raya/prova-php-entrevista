<?php
    include "connection.php";
    $connection = new Connection();
    session_start();
    echo json_encode($_POST);
    $userId = $_POST["user"];
    $colorId = $_POST["color"];

    try{
        $resultQuery = $connection->query("SELECT * FROM user_colors WHERE user_id = {$userId}");

        foreach ($resultQuery as $user){
            if(isset($user)){
                echo json_encode($user);
                $e = "alreadySet";
                $_SESSION['attributeError'] = $e;
                header("Location: attribute_color_form.php");
                exit;
            }
        };

        $connection->query("INSERT INTO user_colors (user_id,color_id) VALUES (
            {$userId},
            {$colorId}
        )");
        header("Location: /");
    }catch(Exception $e){
        $_SESSION['attributeError'] = $e;
        header("Location: attribute_color_form.php");
    }
    
?>