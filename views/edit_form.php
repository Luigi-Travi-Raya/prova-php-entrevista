<?php
    include "./header.php"
?>
<div class="form-container">
<div class="form">
    <h1 class="form-title">Edição de dados</h1>
    <div class="select-container">
        <form action="edit_action.php" method="post">
            <?php
                session_start();
                require 'connection.php';
                $connection = new Connection();
                $id = (int)$_GET['id'];

                if(isset($_SESSION['nameTaken'])){
                    echo "nome em uso";
                }
                if(isset($_SESSION['emailTaken'])){
                    echo "Email em uso";
                }

                try{
                    $colors = $connection->query("SELECT * FROM colors");
                    $userColor = $connection->query("SELECT A.* FROM colors A, user_colors B WHERE A.id=b.color_id AND B.user_id={$id}");
                    $user = $connection->query("SELECT * FROM users WHERE id = {$id}");

                    $color = $colors->fetchAll(PDO::FETCH_NUM);
                    $userInfo = $user->fetch(PDO::FETCH_NUM);
                    $userColorInfo = $userColor->fetch(PDO::FETCH_NUM);

                    if(!$userInfo){
                        throw new Exception("Id Inválido");
                    }
                    echo "
                        <h3 class='input-title'>Nome de Usuário</h3>
                        <input class='input' type='text' name='userName' value='{$userInfo[1]}'>

                        <h3 class='input-title'>Email</h3>
                        <input class='input'  type='email' name='userEmail' id='' value='{$userInfo[2]}'>
                         
                        <h3 class='input-title'>Cor Atribuída</h3>
                        <select class='input' name='color'>";
                    foreach($color as $colorInfo){
                        if($userColorInfo[0]==$colorInfo[0]){
                            echo "<option value='{$colorInfo[0]}' selected>{$colorInfo[1]}</option>";
                        }else{
                            echo "<option value='{$colorInfo[0]}'>{$colorInfo[1]}</option>";
                        }
                    }
                    echo "</select>";
                    $_SESSION['userId'] = $id;
                    $_SESSION['oldUserColor'] = $userColorInfo[0];
                }catch(Exception $e){
                    $_SESSION['editError'] = $e;
                    header("Location: /");
                }
            ?>
            
        <div class="d-flex justify-content-between">
            <a class="form-btn goback-btn" href="/">Voltar</a>
            <button class="form-btn submit-btn" type="submit">Atualizar</button>
        </div>
        
        </form>
    </div>
</div>
</div>

</body>
</html>
