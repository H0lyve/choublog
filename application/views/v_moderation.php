<div class="row navbar-fixed-top mod_nav">
   <div class="col-lg-4">
       <a class="btn btn btn-primary btn-block" href="<?= base_url('index.php/c_main/moderation') ?>">Vignettes</a>
   </div>
   <div class="col-lg-4">
       <a class="btn btn btn-primary btn-block" href="<?= base_url('index.php/c_main/moderation/users') ?>">Utilisateurs</a>
   </div>
   <div class="col-lg-4">
       <a class="btn btn btn-primary btn-block" href="<?= base_url('index.php/c_main/moderation/comments') ?>">Commentaires</a>
   </div>    
</div>
<?php if(isset($vignettes)){
        echo '<hr>';                        
        foreach($vignettes as $vignette){        
            echo '<div class="row';
            if($vignette['vignette_is_first'] == 1)
                echo ' is_first';
            echo '" ';
            if($vignette['vignette_moderation_status'] == 1)
                echo 'style="background-color:#91D486"';
            elseif($vignette['vignette_moderation_status'] == -1)
                echo 'style="background-color:#F58A97"';
            echo'>
                <div class="col-lg-6">
                    <img class="img-responsive" src="'. base_url('public/images/vignette/'.$vignette['vignette_img']).'"/>
                </div>
                <div class="col-lg-3">
                    Poster par :'.$vignette['user_name'].' (id : '.$vignette['user_id'].')
                    <br/>
                    le : '.$vignette['vignette_posted_at'].'
                    <br/>
                    Story_id : '.$vignette['story_id'].'
                </div>
                <div class="col-lg-3">                       
                    <a href="'. base_url('/index.php/c_vignette/moderation/'.$vignette['vignette_id'].'/1') .'" class="btn btn-default">Validation</a>
                    <br/>
                    <a href="'. base_url('/index.php/c_vignette/moderation/'.$vignette['vignette_id'].'/-1') .'" class="btn btn-danger btn-ok">Moderation</a>
                </div></div><hr>';
        }
    }elseif(isset($users)){
        echo '<hr>';                 
        foreach($users as $user){        
            echo '<div class="row" ';
            if($user['user_moderation_status'] == 1)
                echo 'style="background-color:#91D486"';
            elseif($user['user_moderation_status'] == 0)
                echo 'style="background-color:#F58A97"';
            echo'>
                <div class="col-lg-3">
                    Nom : '.$user['user_name'].'
                    <br/>
                    ID : '.$user['user_id'].'
                    <br/>
                    E-mail : '.$user['user_mail_address'].'
                    <br/>
                    Crée le  : '.$user['user_created_at'].'
                </div>
                <div class="col-lg-3">                       
                    <a href="'. base_url('/index.php/c_user/moderation/'.$user['user_id'].'/1') .'" class="btn btn-default">Réabilite</a>
                    <br/>
                    <a href="'. base_url('/index.php/c_user/moderation/'.$user['user_id'].'/0') .'" class="btn btn-danger btn-ok">Ban</a>
                </div></div><hr>';
        }
    }elseif(isset($comments)){
        echo '<hr>';                 
        foreach($comments as $comment){        
            echo '<div class="row" ';
            if($comment['comment_moderation_status'] == 1)
                echo 'style="background-color:#91D486"';
            elseif($comment['comment_moderation_status'] == 0)
                echo 'style="background-color:#F58A97"';
            echo'>
                <div class="col-lg-3">
                    "'.$comment['comment_content'].'"
                </div>
                <div class="col-lg-3">
                    Nom : '.$comment['user_name'].'
                    <br/>
                    ID : '.$comment['user_id'].'
                    <br/>
                    Poster le  : '.$comment['comment_posted_at'].'
                    <br/>
                    Story  : '.$comment['story_id'];
            if($comment['vignette_id'] != null)
                echo'<br/> Vignette : '.$comment['vignette_id'];
            echo'</div>
                <div class="col-lg-3">                       
                    <a href="'. base_url('/index.php/c_comment/moderation/'.$comment['comment_id'].'/1') .'" class="btn btn-default">Réabilite</a>
                    <br/>
                    <a href="'. base_url('/index.php/c_comment/moderation/'.$comment['comment_id'].'/0') .'" class="btn btn-danger btn-ok">Ban</a>
                </div></div><hr>';
        }
    }