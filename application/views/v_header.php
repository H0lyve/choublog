<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Choublog</title>


    <link href="<?=base_url('public/css/bootstrap.min.css')?>" rel="stylesheet">
    <script src="<?=base_url('public/js/jquery.js')?>"></script>
    <script src="<?=base_url('public/js/bootstrap.min.js')?>"></script>
    <link href="<?=base_url('public/css/1-col-portfolio.css')?>" rel="stylesheet">

</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url() ?>">Choublog</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?= base_url('/index.php/c_main/stories') ?>">Histoires</a>
                    </li>
                    <li>
                        <?php if($this->input->cookie('loggin')) : ?>
                        <a href="#" data-href="delete.php?id=23" data-toggle="modal" data-target="#confirm-delete"><b>Marre d'être <?= $this->input->cookie('username') ?></b></a>
                        <?php else : ?>
                        <a href="<?= base_url('/index.php/c_main/loggin') ?>"><b>Inscription/Connexion</b></a>
                        <?php endif;?>
                    </li>
                    <li>
                        <?php if($this->input->cookie('is_admin')) : ?>
                        <a href="<?= base_url('index.php/c_main/moderation') ?>"><b>Modération</b></a>
                        <?php endif;?>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Sûr ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <a href="<?= base_url('/index.php/c_user/logout') ?>" class="btn btn-danger btn-ok">Déconnexion</a>
                </div>
            </div>
        </div>
    </div>