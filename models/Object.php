<?php

class Objects {

    public $id;
    public $title;
    public $image;
    public $description;
    public $users_id;


    public function imageGenerateName() {
        return bin2hex(random_bytes(16)); 
    }
}


interface ObjectDAOInterface {

    public function buildObject($data);
    public function create(Objects $object);
    public function update(Objects $object);
    public function delete($id);
    public function findAll();
    public function findById($id);
    public function findByTitle($title);
    public function findByUserId($id);
    public function findLatestObjects();


  }