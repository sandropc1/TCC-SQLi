<?php

require_once("models/Object.php");
require_once("models/Message.php");


class ObjectDAO implements ObjectDAOInterface {

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url){
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildObject($data){

        $object = new Object();

        $object->id = $data["id"];
        $object->title = $data["title"];
        $object->image = $data["image"];
        $object->description = $data["description"];
        $object->users_id = $data["users_id"];
  
        return $object;
  
    }

    public function create(Object $object){

        $stmt = $this->conn->prepare("INSERT INTO objects(
            title, image, description, users_id
        ) VALUES (
            :title, :image, :description, :users_id
        )");

        $stmt->bindParam(":title", $object->title);
        $stmt->bindParam(":image", $object->image);
        $stmt->bindParam(":description", $object->description);
        $stmt->bindParam(":users_id", $object->users_id);

        $stmt->execute();

        $this->message->setMessage("Objeto adicionado com sucesso!", "success", "index.php");

    }
    public function update(Object $object){

    }
    public function delete($id){

    }
    public function findAll(){

    }
    public function findById($id){

    }
    public function findByTitle($title){

    }
    public function findByUserId($id){

    }
    public function findLatestObjects(){

    }

}