<?php
    require "user_model.php";
    require "colors_model.php";
    require "../connection.php";
    require "user_colors_model.php";

    $connection = new Connection();
    $colorsModel = new Color($connection);
    $userModel = new User($connection);
    $userColorsModel = new UserColors($connection, $userModel);

    echo json_encode($colorsModel->findOneById(3));
?>