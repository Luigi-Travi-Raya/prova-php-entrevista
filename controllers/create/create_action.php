<?php
    require 'connection.php';
    $connection = new Connection();
    session_start();
    $userName = $_POST["userName"];
    $userEmail = $_POST["userEmail"];
    try {

        $queryResult = $connection->query("SELECT * FROM users WHERE name = '{$_POST['userName']}'");
        $result = $queryResult->fetchAll(PDO::FETCH_NUM);

        if($result){
            if(count($result)>0){
                $_SESSION['nameTaken'] = true;
                header("Location: create_form.php");
                exit;
            }
        }


        $queryResult = $connection->query("SELECT * FROM users WHERE email = '{$_POST['userEmail']}'");
        $result = $queryResult->fetchAll(PDO::FETCH_NUM);

        if($result){
            if(count($result)>0){
                $_SESSION['emailTaken'] = true;
                header("Location: create_form.php");
                exit;
            }
        }
        echo $userEmail;
        echo $userName;
        $connection->query("INSERT INTO users (name, email)
                            VALUES ('$userName', '$userEmail')");

        header("Location: /");
    }catch (Exception $e){
        $_SESSION["createError"] = $e;
        header("Location: create_form.php");
    }
?>