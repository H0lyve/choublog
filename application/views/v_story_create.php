<div class="container"> 
    <div class="row">
        <div class="col-lg-6 form-group">
            <?php 
                $attributes = array('enctype'=> "multipart/form-data");
                echo form_open('index.php/c_story/create',$attributes);
            ?>
            <input type="hidden" value="<?= $this->input->cookie('id') ?>" name="user_id">
            <fieldset >
                <legend>Crée le point de départ d'une nouvelle aventure de Chou :</legend>
                <label>Titre :</label>
                <br/>
                <input type="text" name="title" placeholder="Titre de l'aventure de Chou" required> 
                <br/>
                <label>Description :</label>
                <br/>
                <textarea rows="4" cols="50" name="description" placeholder="Donnée l'idée général de votre histoire aux autres Chou" required></textarea>
                <br/>
                <label>Première vignette :</label>
                <br/>
                <div style="position:relative;">
                    <a class='btn btn-primary' href='javascript:;'>
                        Choisie
                        <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="image" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
                    </a>
                    &nbsp;
                    <span class='label label-info' id="upload-file-info"></span>
                </div>
                <br/>
                <button type="submit" class="btn btn-default">J'envoie</button>
            </fieldset>
            <?= form_close() ?>
        </div>
    </div>
</div>