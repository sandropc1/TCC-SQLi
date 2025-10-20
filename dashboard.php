<?php
require_once("templates/init.php");

require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("dao/ObjectDAO.php");

        $user = new User();
        $userDao = new UserDAO($conn, $BASE_URL);
        $objectDao = new ObjectDAO($conn, $BASE_URL);

        $userData = $userDao->verifyToken(true);

        $userObjects = $objectDao->findByUserId($userData->id);

require_once("templates/header.php");
?>
  <div id="main-container" class="container-fluid">
    <h2 class="section-title">Dashboard</h2>
    <p class="section-description">Adicione ou atualize os seus objetos</p>
    <div class="col-md-12" id="add-object-container">
      <a href="<?= $BASE_URL ?>newobject.php" class="btn card-btn">
        <i class="fas fa-plus"></i> Adicionar objeto
      </a>
    </div>
    <div class="col-md-12" id="object-dashboard">
      <table class="table">
        <thead>
          <th scope="col">#</th>
          <th scope="col">Título</th>
          <th scope="col" class="actions-column">Ações</th>
        </thead>
        <tbody>
            <?php foreach($userObjects as $object): ?>
          <tr>
            <td scope="row"><?= $object->id ?></td>
            <td><a href="<?= $BASE_URL ?>object.php?id=<?= $object->id?>" class="table-object-title"><?= $object->title ?></a></td>
            <td class="actions-column">
              <a href="<?= $BASE_URL ?>editmovie.php?id=<?= $object->id ?>" class="edit-btn">
                <i class="far fa-edit"></i> Editar
              </a>
              <form action="<?= $BASE_URL ?>object_process.php" method="POST">
                <input type="hidden" name="type" value="delete">
                <input type="hidden" name="id" value="<?= $object->id ?>">
                <button type="submit" class="delete-btn">
                  <i class="fas fa-times"></i> Deletar
                </button>
              </form>
            </td>
             </tr>
            <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
    <?php
        require_once("templates/footer.php");
    ?>
