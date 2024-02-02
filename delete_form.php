<?php
    include "header.php";
?>
<div class="form-container">
    <div class="form">
        <h1 class="form-title">Excluir Usuário</h1>
        <div class="select-container">
            <form action="create_action.php" method="post">
                <h3 class="input-title delete-text">Tem certeza que deseja excluir permanentemente este usuário?</h3>
                <?php

                ?>
                <div class="d-flex justify-content-between">
                    <a class="form-btn goback-btn" href="/">Voltar</a>
                    <button class="form-btn submit-btn delete-btn " type="submit">Excluir</button>
                </div>            
            </form>
        </div>
    </div>
</div>
</body>
</html>
