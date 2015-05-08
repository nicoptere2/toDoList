<h3>Supprimer un membre de la liste</h3>
<?php echo $this->Form->create('Member');
?>
   <div align="center">
    <!-- Ici, affichage d'une liste selection multiple (dans le cas de plusieurs suppression d'un coup ?)
        Avec liste limité a l'affichage de 3 éléments max-->
        <select multiple size="3" align="center">
    <?php
    foreach ($members as $key => $value){
        if($value['Member']['right_id']!=3) { //right_id = 3 <==> owner de la liste
    ?>
              <option class="<?php if($value['Member']['right_id']==0) echo 'OptionNoRight';
                                    elseif($value['Member']['right_id']==1) echo 'OptionMidRight';
                                    else echo 'OptionAllRight';?>"

                      value="<?php echo $value['User']['username']?>" ><?php echo $value['User']['username']?></option><!--couleur users all droit?-->
                      <!-- Vus qu'on ne peut déterminer si l'utilisateur est l'owner, faire un test avant-->
    <?php }} ?>
        </select>
        <br>
        <p><button align="left">Supprimer</button><button align="right">Annuler</button></p>
    </div>