<?php
    include "./header.php"
?>
<div class="form-container">
    <div class="form">
        <h1 class="form-title">Atribuição de cores</h1>
        <div class="select-container">
            <form action="attribute_color_action.php" method="post">
            <?php

                require 'connection.php';
                $connection = new Connection();
                $users = $connection->query("SELECT * FROM users");
                $colors = $connection->query("SELECT * FROM colors");
                session_start();

                if(isset($_SESSION["attributeError"])){
                    if($_SESSION["attributeError"] == "alreadySet"){
                        echo "<h3 class='error'>Este usuário já possui cor atribuída. Edite <a href='#'>aqui</a></h3>";
                    }else{
                        echo "<h3 class='error'>Utilize um valor válido!{$_SESSION['attributeError']}</h3>";
                    }
                    
                }

                echo "<h3 class='input-title'>Usuário </h3>";

                echo " <select class='input' name='user' id='user'>";
                foreach($users as $user){
                    echo "<option value='{$user->id}'>{$user->name}</option>";
                }
                echo "</select>";

                echo "<h3 class='input-title'>Cor </h3>";

                echo "<select class='input' name='color' id='color'>";
                foreach($colors as $color){
                    echo "<option value='{$color->id}'>{$color->name}</option>";
                }
                echo "</select>";
            ?>
            <div class="d-flex justify-content-between">
                <a class="form-btn goback-btn" href="/">Voltar</a>
                <button class="form-btn submit-btn" type="submit">Enviar</button>
            </div>
            
            </form>
        </div>
    </div>
</div>

</body>
</html>
