<?php


if(!empty($object->image)){
    $object->image = "object.png";

}

?>

<div class="card object-card">
    <div class="card-img-top" style="background-image: url('<?= $BASE_URL ?>img/object.png')"></div>
    <div class="card-body">
        <h5 class="card-title"><a href="<?= $BASE_URL?>Object.php?id=<?=$object->id?>"> <?=$object->title?></a></h5>
        
        <a href="<?= $BASE_URL?>Object.php?id=<?=$object->id?>" class="btn btn-primary card-btn">Conhecer</a>
    </div>
</div>