<div class="container"> 
    <div class="row">
        <div class="col-lg-6 form-group">
            <?php
                $attributes = array('enctype'=> "multipart/form-data");
                echo form_open('index.php/c_vignette/add',$attributes);
            ?>
            <input type="hidden" value="<?= $this->input->cookie('id') ?>" name="user_id">
            <fieldset >
                <legend>Ajouter une nouvelle vignette de cette aventure de Chou :</legend>
                <input type="hidden" name="story_id" value="<?= $story_id ?>">
                <div style="position:relative;">
                    <a class='btn btn-primary' href='javascript:;'>
                        Choisie
                        <input type="file" class='file_input' name="image" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
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