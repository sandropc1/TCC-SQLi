<?php
require_once("globals.php");
require_once("db.php");
require_once("models/Object.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("dao/ObjectDAO.php");

$message   = new Message($BASE_URL);
$userDAO   = new UserDAO($conn, $BASE_URL);
$objectDAO = new ObjectDAO($conn, $BASE_URL);

$type = filter_input(INPUT_POST, "type");

$userData = $userDAO->verifyToken();

if ($type === "create") {

    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");

    // Atenção ao nome da classe: verifique se é Object (singular)
    $object = new Objects();

    if (!empty($title) && !empty($description)) {

        $object->title = $title;
        $object->description = $description;
        $object->users_id  = $userData->id;

        // === Upload da imagem (antes de inserir no BD) ===
        if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

            $image = $_FILES["image"];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray   = ["image/jpeg", "image/jpg"];

            if (in_array($image["type"], $imageTypes)) {

                if (in_array($image["type"], $jpgArray)) {
                    $imgRes = imagecreatefromjpeg($image["tmp_name"]);
                    $ext = ".jpg";
                } else {
                    $imgRes = imagecreatefrompng($image["tmp_name"]);
                    $ext = ".png";
                }

                if (!$imgRes) {
                    $message->setMessage("Falha ao processar a imagem.", "error", "back");
                }

                // Gere um nome (use seu método do modelo)
                $imageName = $object->imageGenerateName() . $ext;

                // Garanta que a pasta exista e tenha permissão (chmod 775/777 conforme ambiente)
                $destPath = __DIR__ . "/img/objects/" . $imageName;

                // Salva sempre em JPG de alta qualidade (ou use lógica por tipo)
                imagejpeg($imgRes, $destPath, 100);
                imagedestroy($imgRes);

                $object->image = $imageName;

            } else {
                $message->setMessage("Tipo inválido de imagem, envie PNG ou JPG.", "error", "back");
            }
        }

        // === Agora insere já com $object->image (se houver) ===
        $objectDAO->create($object);

        // Só depois de tudo, manda a mensagem/redirect
        $message->setMessage("Objeto adicionado com sucesso!", "success", "index.php");

    } else {
        $message->setMessage("Por favor, preencha todos os campos!", "error", "back");
    }

}else if($type === "delete"){

    $id = filter_input(INPUT_POST, "id");

    $object = $objectDAO->findById($id);

    $objectDAO->delete($id);

} else if($type === "update"){

    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $id = filter_input(INPUT_POST, "id");

    $objectData = $objectDAO->findById($id);

    if($objectData && $objectData->users_id === $userData->id){

        if (!empty($title) && !empty($description)) {
            $objectData->title = $title;
            $objectData->description = $description;

             // === Upload da imagem (antes de inserir no BD) ===
        if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

            $image = $_FILES["image"];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray   = ["image/jpeg", "image/jpg"];

            if (in_array($image["type"], $imageTypes)) {

                if (in_array($image["type"], $jpgArray)) {
                    $imgRes = imagecreatefromjpeg($image["tmp_name"]);
                    $ext = ".jpg";
                } else {
                    $imgRes = imagecreatefrompng($image["tmp_name"]);
                    $ext = ".png";
                }

                if (!$imgRes) {
                    $message->setMessage("Falha ao processar a imagem.", "error", "back");
                }

                // Gere um nome (use seu método do modelo)
                $imageName = $objectData->imageGenerateName() . $ext;

                // Garanta que a pasta exista e tenha permissão (chmod 775/777 conforme ambiente)
                $destPath = __DIR__ . "/img/objects/" . $imageName;

                // Salva sempre em JPG de alta qualidade (ou use lógica por tipo)
                imagejpeg($imgRes, $destPath, 100);
                imagedestroy($imgRes);

                $objectData->image = $imageName;

            } else {
                $message->setMessage("Tipo inválido de imagem, envie PNG ou JPG.", "error", "back");
            }
        }
            $objectDAO->update($objectData);
            
        }else {
            $message->setMessage("Nenhuma informação alterada", "error", "back");
        }
    } else {

            $message->setMessage("Informações inválidas", "error", "index.php");
        }
} else {
    $message->setMessage("Informações inválidas!", "error", "index.php");
}
