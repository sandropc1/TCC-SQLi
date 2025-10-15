<?php

class Objects {

    public $id;
    public $title;
    public $image;
    public $description;
    public $users_id;

}


interface ObjectDAOInterface {

    public function buildObject($data);
    public function create(Object $object);
    public function update(Object $object);
    public function delete($id);
    public function findAll();
    public function findById($id);
    public function findByTitle($title);
    public function findByUserId($id);
    public function findLatestObjects();


  }