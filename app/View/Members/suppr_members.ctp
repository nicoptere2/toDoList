<h3>Supprimer un membre de la liste</h3>
<?php echo $this->Form->create('Member');
?>
  <div align="center">
   <?php 
   foreach ($members as $key => $value){
    if($value['Member']['right_id']!=2)
      $options[$value['User']['username']] = $value['User']['username'];
   }
   //debug($options);
    echo $this->Form->input('pseudo', array('options' => $options)); ?>
    <!-- Ici, affichage d'une liste selection multiple (dans le cas de plusieurs suppression d'un coup ?)
        Avec liste limité a l'affichage de 3 éléments max-->

        <!--
        <select multiple size="3" align="center">
    <?php
    //debug($members);
    foreach ($members as $key => $value){
        if($value['Member']['right_id']!=2) { //right_id = 2 <==> owner de la liste
    ?>
              <option class="<?php if($value['Member']['right_id']==2) echo 'OptionNoRight';
                                    elseif($value['Member']['right_id']==3) echo 'OptionMidRight';
                                    else echo 'OptionAllRight';?>"

                      value="<?php echo $value['User']['username']?>" ><?php echo $value['User']['username']?></option><!--couleur users all droit?-->
                      <!-- Vus qu'on ne peut déterminer si l'utilisateur est l'owner, faire un test avant-->
    <!--<?php }} ?>
        </select>
        <br>
        <p>-->
        <?php echo $this->Form->end('Valider'); ?>
        <!--<button align="right">Annuler</button></p>-->
    </div>