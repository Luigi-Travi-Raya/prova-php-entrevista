<?php
    require 'connection.php';
    $connection = new Connection();
    session_start();
    try {

        $queryResult = $connection->query("SELECT * FROM users WHERE name = '{$_POST['userName']}'");
        $result = $queryResult->fetchAll(PDO::FETCH_NUM);

        if($result){
            if($result[0][0] != $_SESSION['userId'] AND count($result)>0){
                $_SESSION['nameTaken'] = true;
                header("Location: edit_form.php?id={$_SESSION['userId']}");
                exit;
            }
        }


        $queryResult = $connection->query("SELECT * FROM users WHERE email = '{$_POST['userEmail']}'");
        $result = $queryResult->fetchAll(PDO::FETCH_NUM);

        if($result){
            if($result[0][0] != $_SESSION['userId'] AND count($result)>0){
                $_SESSION['emailTaken'] = true;
                header("Location: edit_form.php?id={$_SESSION['userId']}");
                exit;
            }
        }


        $connection->query(
            "UPDATE users 
                SET 
                name = '{$_POST['userName']}',
                email = '{$_POST['userEmail']}'
                WHERE id = {$_SESSION['userId']}
            ");
        
        if($_POST['color'] != $_SESSION['oldUserColor']){
            $connection->query(
                "UPDATE user_colors 
                    SET 
                    color_id = {$_POST['color']}
                    WHERE user_id = {$_SESSION['userId']}
                ");
        }

        header('Location: /');
    } catch (Exception $e){
        $_SESSION['editError'] = $e;
        header("Location: /");
    }
?>