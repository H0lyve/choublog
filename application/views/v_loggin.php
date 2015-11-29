<div class="container"> 
    <div class="row">
        <div class="col-lg-6 form-group">
            <?= form_open('index.php/c_user/register') ?>
               <table class="table table-condensed">
                    <tr>
                        <th colspan="2"><h1>Je veut devenir Chou !</h1></th>
                    </tr>
                    <tr>
                        <td><label>Adresse e-mail</label></td>
                        <td><input type="email" name="mail" required></td>
                    </tr>
                    <tr>
                        <td><label>Mot de passe</label></td>
                        <td><input type="password" name="psw" required></td>
                    </tr>
                    <tr>
                        <td><label>Re Mot de passe</label></td>
                        <td><input type="password" name="psw_check" required></td>
                    </tr>
                    <tr>
                        <td><label>Nom de Chou</label></td>
                        <td><input type="text" name="name" required></td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="2"><button class="btn btn-default" type="submit">Je m'inscris</button></td>
                    </tr>
                </table>
            <?= form_close() ?>
        </div>
        <div class="col-lg-6 form-group">
           <?php echo validation_errors(); ?>
           <?php echo form_open('index.php/verifylogin'); ?>
            <table class="table table-condensed">
                <tr>
                    <th colspan="2"><h1>Je suis déjà Chou</h1></th>
                </tr>
                <tr>                
                    <td><label for="username">Nom :</label></td>
                    <td><input type="text" size="20" id="username" name="username"/></td>
                </tr>
                <tr>
                    <td><label for="password">Password :</label></td>
                    <td><input type="password" size="20" id="passowrd" name="password"/></td>
                </tr>
                <tr class="text-center">
                    <td colspan="2"><input  class="btn btn-default" type="submit" value="Connexion"/></td>
                </tr>
            </table>
            <?= form_close() ?>         
        </div>
    </div>
</div>