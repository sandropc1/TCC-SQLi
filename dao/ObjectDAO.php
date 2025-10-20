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

        $object = new Objects();

        $object->id = $data["id"];
        $object->title = $data["title"];
        $object->image = $data["image"];
        $object->description = $data["description"];
        $object->users_id = $data["users_id"];
  
        return $object;
  
    }

    public function create(Objects $object){

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

        $object = [];

        $stmt = $this->conn->prepare("SELECT * FROM objects WHERE id = :id");

        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $objectData = $stmt->fetch();

            $object = $this->buildObject($objectData); 

            return $object;
        }
        
            return false;
    }

    public function findByTitle($title){
        
        $objects = [];

        $stmt = $this->conn->prepare("SELECT * FROM objects WHERE title LIKE :title");

        $stmt->bindValue(":title", '%'.$title.'%');
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $objectArray = $stmt->fetchAll();

            foreach($objectArray as $object){
                $objects[] = $this->buildObject($object);
            }
        }
        
            return $objects;
    }

    public function findByUserId($id){

        $objects = [];

        $stmt = $this->conn->prepare("SELECT * FROM objects
                                        WHERE users_id = :users_id");

        $stmt->bindParam(":users_id", $id);

        $stmt->execute();

        if($stmt->rowCount() > 0) {

            $objectsArray = $stmt->fetchAll();

            foreach($objectsArray as $object) {
            $objects[] = $this->buildObject($object);
            }

      }

      return $objects;
    }
    public function findLatestObjects(){

        $objects = [];

        $stmt = $this->conn->prepare("SELECT * FROM objects ORDER BY id DESC");

        $stmt->execute();

        if($stmt->rowCount() > 0){

            $objectsArray = $stmt->fetchAll();

            foreach($objectsArray as $objectItem){
                $objects[] = $this->buildObject($objectItem);
            }
        }
            return $objects;
    }

}