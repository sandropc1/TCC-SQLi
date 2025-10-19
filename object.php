<?php 

require_once("templates/init.php");

require_once("dao/ObjectDAO.php");
require_once("models/Object.php");


$id = filter_input(INPUT_GET, "id");

$object;

$objectDao = new ObjectDAO($conn, $BASE_URL);

if(empty($id)){
    $message->setMessage("O objeto não foi encontrado!", "error", "index.php");
} else {

$object = $objectDao->findById($id); // Verifica se o filme existe

    if(!$object){ 
      $message->setMessage("O objeto não foi encontrado!", "error", "index.php");
    }

}
    require_once("templates/header.php");

?>

<div id="main-container" class="container-fluid">
    <div class="row">
        <div class="offset-md-1 col-md-6 object-container">
            <h1 class="page-title"> <?= $object->title ?></h1>
        </div>
    </div>
</div>

<?php
    require_once("templates/footer.php");
?>