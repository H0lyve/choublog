<div class="container">
    <div class="row">   
        <div class="col-md-1"> 
        </div>
        <div class="col-md-5">
            <h3><?= $story['data']['story_title'] ?></h3>
            <p><?= $story['data']['story_description'] ?></p>
            <hr>
        </div>
    </div>
    <?php
    foreach($story['vignettes'] as $cle=>$vignette) :
    ?>

    <div class="row">
        <div class="col-md-1"> 
        </div>
        <div class="col-md-6">
            <img class="img-responsive" src="<?= base_url('public/images/vignette/'.$vignette['vignette_img']) ?>" alt="">
        </div>
        <div class="col-md-5">
            <div class="detailBox">
                <div class="titleBox">
                  <label>Posté par <?= $vignette['user_name']?> le <?= $vignette['vignette_posted_at']?></label>
                </div>
                <div class="actionBox">
                    <?php 
                        $attributes = array('enctype'=> "multipart/form-data",
                                            'class' => "form-inline",
                                            'role' => "form");
                        echo form_open('index.php/c_comment/add',$attributes);
                    ?>
                    <div class="form-group">
                        <input type="hidden" name="story_id" value="<?= $story['data']['story_id']?>" />
                        <input type="hidden" value="<?php if(!empty($this->input->cookie('id'))) { echo $this->input->cookie('id') ;} ?>" name="user_id">
                        <input type="hidden" value="<?= $vignette['vignette_id'] ?>" name="vignette_id">
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
                      <?php foreach($story['comments'] as $comment) : 
                                if($comment['vignette_id'] == $vignette['vignette_id']) :?>
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

    <?php 
    endforeach; 
    ?>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <?php   
                if(!empty($token['active_token']) && $this->input->cookie('loggin')) {
                    if($token['active_token']['user_id'] == $this->input->cookie('id')) {
                        echo '<a class="btn btn btn-primary btn-block" href="'. base_url('/index.php/c_main/vignette_add/'.$story['data']['story_id']).'">Ajouter une vignette</a>';
                    }else{
                        echo '<a class="btn btn btn-primary btn-block"> Le token est été prit. Si personne ne poste avant le '.$token['active_token']['token_end'].', tu aura peu être ta chance pour cette vignette</a>';
                    }
                }elseif(empty($token['active_token']) && $this->input->cookie('loggin')) {
                    if(!empty($token['last_token']) && $token['last_token']['user_id'] == $this->input->cookie('id'))
                        echo '<a class="btn btn btn-primary btn-block">Tu as deja prit le token la dernière fois</a>';
                    else
                        echo '<a class="btn btn btn-primary btn-block" href="'. base_url('/index.php/c_story/take_token/'.$story['data']['story_id'].'/'.$this->input->cookie('id')).'">Je prend le token !</a>';
                }else{
                    echo '<a class="btn btn btn-primary btn-block" href="'. base_url('/index.php/c_main/loggin').'">Connecte toi ou rejoint nous pour poster des vignette </a>';
                }
            ?>
        </div>
    </div>
</div>