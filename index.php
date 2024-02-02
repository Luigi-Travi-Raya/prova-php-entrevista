<?php
    include "./header.php"
?>
<div class="main-content">
    <?php
    session_start();
    require 'connection.php';
    $connection = new Connection();

    $users = $connection->query("SELECT A.id as user_id,
                                        A.name as user_name,
                                        C.id as color_id,
                                        C.name as color_name,
                                        A.email FROM users A, user_colors B, colors C 
                                        WHERE A.id = B.user_id AND B.color_id = C.id ORDER BY user_id");

    echo "<table border='1'>

        <tr >
            <th>ID</th>    
            <th>Nome</th>    
            <th>Email</th>
            <th>Ação</th>    
        </tr>
    ";

    foreach($users as $user) {
        echo "<tr>
                <td>{$user->user_id}</td>
                <td style='color:{$user->color_name}'>{$user->user_name}</td>
                <td>{$user->email}</td>
                <td>
                    <a class='edit-btn' href='edit_form.php?id={$user->user_id}'>EDITAR</a>
                    <a class='delete-btn' href='delete_form.php?id={$user->user_id}'>EXCLUIR</a>
                </td>
              </tr>";

    }

    echo "</table>";
    if(isset($_SESSION['editError'])){
        echo "<script>alert(`{$_SESSION['editError']}`);";
        echo "javascript:window.location='/';</script>";
    }
    session_unset();
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>