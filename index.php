<?php
require_once("templates/header.php");
?>
    
    <div id="main-container" class="container-fluid">
        <h2 class="section-title">Objetos novos</h2>
        <p class="section-description">Lista de objetos:</p>
        <div class="objects-container">
            <div class="card object-card">
                <div class="card-img-top" style="background-image: url('<?= $BASE_URL ?>img/object.png')"></div>
                <div class="card-body">
                    <h5 class="card-title"><a href="#">Objeto</a></h5>
                    <a href="#" class="btn btn-primary card-btn">Conhecer</a>
                </div>
        </div>
    </div>
    <?php
        require_once("templates/footer.php");
    ?>
