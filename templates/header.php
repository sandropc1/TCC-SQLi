<?php
if (!isset($userData)) {
    // segurança, caso header.php seja chamado sozinho
    require_once("templates/init.php");
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCC</title>
    <link rel="short icon" href="<?= $BASE_URL ?>img/skull-32-16.ico" />
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.css" integrity="sha512-VcyUgkobcyhqQl74HS1TcTMnLEfdfX6BbjhH8ZBjFU9YTwHwtoRtWSGzhpDVEJqtMlvLM2z3JIixUOu63PNCYQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS-->
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/style.css">
</head>
<body>
    <header>
        <nav id="main-navbar" class = "navbar navbar-expand-lg">
            <a href="<?= $BASE_URL ?>" class = "navbar-brand">
                <img src="<?= $BASE_URL ?>img/logo.png" alt = "Logo" id = "logo">
                <span id = "tcc-title">TCC</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" 
            data-target="#navbar" aria-controls = "navbar" aria-expanded = "false" aria-label = "Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <form action="" method="GET" id="search-form" class="form-inline my-2 my-lg-0">
                <input type="text" name="q" id="search" class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
                <button class="btn my-2 my-sm-0" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div class="collapse navbar-collapse" id = "navbar">
                <ul class = "navbar-nav">
                <?php if($userData): ?>
                    <li class="nav-item">
                    <a href="<?= $BASE_URL ?>newobject.php" class="nav-link">
                    </a>
                    </li>
                    <li class="nav-item">
                    <a href="<?= $BASE_URL ?>newobject.php" class="nav-link">Meus Objetos</a>
                    </li>
                    <li class="nav-item">
                    <a href="<?= $BASE_URL ?>editprofile.php" class="nav-link bold">
                        <?= $userData->name ?>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a href="<?= $BASE_URL ?>logout.php" class="nav-link">Sair</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a href="<?= $BASE_URL ?>auth.php" class = "nav-link">Entrar / Cadastrar</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>
    <?php if(!empty($flassMessage["msg"])): ?>
        <div class="msg-container">
            <p class = "msg <?= $flassMessage["type"] ?>"><?= $flassMessage["msg"] ?></p>
        </div>
    <?php endif; ?>
    