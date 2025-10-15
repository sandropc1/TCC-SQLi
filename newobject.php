<?php
require_once("templates/header.php");

require_once("models/User.php");
require_once("dao/UserDAO.php");

        $user = new User();
        $userDao = new UserDAO($conn, $BASE_URL);

        $userData = $userDao->verifyToken(true);
?>
    
    <div id="main-container" class="container-fluid">
        <div class = "offset-md-4 col-md-4 new-object-container">
            <h1 class="page-title">Adicionar Objeto</h1>
            <p class="page-description">Adicione seu objeto</p>
            <form action="<?= $BASE_URL ?>object_process.php" id="add-object-form" method="POST"
            enctype="multipart/form-data">
                <input type="hidden" name="type" value="create">
                <div class="form-group">
                    <label for="title">Título:</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Digite o nome do objeto:">
                </div>
                 <div class="form-group">
                    <label for="image">Imagem:</label>
                    <input type="file" class="form-control-file" id="image" name="title">
                </div>
                 <div class="form-group">
                    <label for="description">Descrição:</label>
                    <textarea name="description" id="description" rows = "5" class="form-control" placeholder = "Descreva o objeto:"></textarea>
                </div>
                <input type="submit" class="btn card-btn" value="Adicionar Objeto">
            </form>
        </div>
    </div>
    <?php
        require_once("templates/footer.php");
    ?>
