<?php
require_once("templates/header.php");

require_once("dao/ObjectDAO.php");

        $objectDao = new ObjectDAO($conn, $BASE_URL);

        $q = filter_input(INPUT_GET, "q");

        $objects = $objectDao->findByTitle($q);

?>

    <div id="main-container" class="container-fluid">
        <h2 class="section-title">Você está buscando por: <span id="search-result"><?= $q ?></span></h2>
        <p class="section-description">Resultados encontrados.</p>
        <div class="objects-container">
        <?php foreach($objects as $object): ?>
            <?php require("templates/object_card.php"); ?>
        <?php endforeach; ?>
        <?php if(count($objects) === 0): ?>
            <p class="empty-list">Nenhum objeto encontrado</p>
        <?php endif; ?>
    </div>
    <?php
        require_once("templates/footer.php");
    ?>
