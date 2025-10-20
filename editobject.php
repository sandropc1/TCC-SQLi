<?php
require_once("templates/init.php");

require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("dao/ObjectDAO.php");

        $user = new User();
        $userDao = new UserDAO($conn, $BASE_URL);

        $userData = $userDao->verifyToken(true);

        $objectDao = new ObjectDAO($conn, $BASE_URL);

        $id = filter_input(INPUT_GET, "id");

        if(empty($id)){

            $message->setMessage("O objeto não foi encontrado!", "error", "index.php");

        }else{

            $object = $objectDao->findById($id); // Verifica se o filme existe

        if(!$object){ 
        
            $message->setMessage("O objeto não foi encontrado!", "error", "index.php");
            
        }
    }

    $isOwner = (int)$object->users_id === (int)$userData->id;

    if (!$isOwner) {
        http_response_code(403);
        $message->setMessage("Objeto não encontrado", "error", "index.php");
        exit; 
    }

        if($object->image == "") {
            $object->image = "object.png";
        }

        require_once("templates/header.php");
?>

    <div id="main-container" class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 offset-md-1">
                    <h1><?= $object->title ?></h1>
                    <p class="page-description">Altere os dados do objeto:</p>
                    <form id="edit-object-form" action="<? $BASE_URL ?>object_process.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="type" value="update">
                    <input type="hidden" name="id" value="<?= $object->id ?>">
                    <div class="form-group">
                        <label for="title">Título:</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Digite o nome do objeto:" value="<?= $object->title ?>">
                    </div>
                    <div class="form-group">
                        <label for="image">Imagem:</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição:</label>
                        <textarea name="description" id="description" rows = "5" class="form-control" placeholder = "Descreva o objeto:"><?= $object->description?></textarea>
                    </div>
                    <input type="submit" class="btn card-btn" value="Editar Objeto">
                    </form>
                </div>
                <div class="col-md-5">
                    <div class="object-image-container" style="background-image: url('<?= $BASE_URL ?>/img/objects/<?= $object->image?>')"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
    require_once("templates/footer.php");
?>