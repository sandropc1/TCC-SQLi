<?php
require_once("templates/header.php");

require_once("dao/ObjectDAO.php");

        $objectDao = new ObjectDAO($conn, $BASE_URL);

        $latestObjects = $objectDao->findLatestObjects();

?>
    
    <div id="main-container" class="container-fluid">
        
        <h2 class="section-title">Objetos novos</h2>
        <p class="section-description">Lista de objetos:</p>
        <div class="objects-container">
        <?php foreach($latestObjects as $object): ?>
            <?php require("templates/object_card.php"); ?>
        <?php endforeach; ?>
        <?php if(count($latestObjects) === 0): ?>
            <p class="empty-list">Ainda não há objetos cadastrados!</p>
        <?php endif; ?>
         </div>
    </div>
    <?php
        require_once("templates/footer.php");
    ?>
