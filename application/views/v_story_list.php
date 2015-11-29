
<!-- Page Content -->
<div class="container"> 
     <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-9">
            <h1 class="page-header">Les Histoires
                <small>La liste des aventures de Chou</small>
            </h1>
        </div>      
    </div>
    <div class="row">      
        <div class="col-lg-12"> 
            <a class="btn btn btn-primary btn-block" href="<?= base_url('/index.php/c_main/story_create') ?>">Crée une nouvelle histoire</a>
        </div> 
    </div>
    <hr>
    <?php
        foreach($stories as $cle=>$story) :
    ?>

        <!-- Project One -->
        <div class="row">
            <div class="col-md-7">
                <a href="<?= base_url('/index.php/c_main/story/'.$story['story_id']) ?>">
                    <img class="img-responsive" src="<?= base_url('public/images/vignette/'.$story['vignette_img']) ?>" alt="">
                </a>
            </div>
            <div class="col-md-5">
                <h3><?= $story['story_title'] ?></h3>
                <p><?= $story['story_description'] ?></p>
                <a class="btn btn-primary" href="<?= base_url('/index.php/c_main/story/'.$story['story_id']) ?>">Voir cette histoire <span class="glyphicon glyphicon-chevron-right"></span></a>
                <br/>
                <div class="detailBox">
                    <div class="titleBox">
                      <label>Posté par <?= $story['user_name']?> le <?= $story['story_created_at']?></label>
                    </div>
                    <div class="actionBox">                        
                            <?php 
                                $attributes = array('enctype'=> "multipart/form-data",
                                                    'class' => "form-inline",
                                                    'role' => "form");
                                echo form_open('index.php/c_comment/add',$attributes);
                            ?>
                            <div class="form-group">
                                <input type="hidden" name="story_id" value="<?= $story['story_id']?>" />
                                <input type="hidden" value="<?php if(!empty($this->input->cookie('id'))) { echo $this->input->cookie('id') ;} ?>" name="user_id">
                                <input class="form-control" name="content" type="text" placeholder="Ton commentaire" />
                            </div>
                            <div class="form-group">
                               <?php if($this->input->cookie('loggin')) : ?>
                                <button class="btn btn-default">OK</button>
                                <?php else : ?>
                                <button type="button" class="btn btn-default" data-toggle="tooltip" title="Il faut être connecté, pour poster un commentaire !">Nope</button>
                                <?php endif; ?>
                            </div>
                           <?= form_close() ?>
                           <ul class="commentList">
                            <?php foreach($comments as $comment) : 
                                if($comment['story_id'] == $story['story_id']) :?>
                                    <li>
                                        <div class="commentText">
                                            <p class=""><?= $comment['comment_content']?></p> <span class="date sub-text">par <?= $comment['user_name']?> le <?= $comment['comment_posted_at']?></span>
                                        </div>
                                    </li>
                                <?php 
                                endif;
                            endforeach; 
                           ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        
        <hr>
    <?php endforeach; ?>

        <!-- Pagination
        <div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li>
                        <a href="#">&laquo;</a>
                    </li>
                    <li class="active">
                        <a href="#">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">5</a>
                    </li>
                    <li>
                        <a href="#">&raquo;</a>
                    </li>
                </ul>
            </div>
        </div>
        -->
