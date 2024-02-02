<?php
    include "header.php";
?>
<div class="form-container">
    <div class="form">
        <h1 class="form-title">Criar Usuário</h1>
        <div class="select-container">
            <form action="create_action.php" method="post">
                <?php
                    session_start();
                    echo $_SESSION["createError"];
                    echo $_SESSION["nameTaken"];
                    echo $_SESSION["emailTaken"];


                ?>

                <h3 class="input-title">Nome de usuário</h3>
                <input class="input" type="text" name="userName">
                <h3 class="input-title">Email</h3>
                <input class="input" type="email" name="userEmail">

                <div class="d-flex justify-content-between">
                    <a class="form-btn goback-btn" href="/">Voltar</a>
                    <button class="form-btn submit-btn" type="submit">Criar</button>
                </div>            
            </form>
        </div>
    </div>
</div>
</body>
</html>
