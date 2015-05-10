
    <h3>Utilisateurs de la liste</h3>
    <?php echo "<table style=\"width:100%\">";

        $owner = false;
        $disabled = true;
        if($myself['Right']['id'] == 2){
            $owner = true;
            $disabled = false;
        }

    	foreach ($members as $key => $value){
            //debug($value['User']['username']) ?>
    		<tr>
                <td>    <?php echo $value['User']['username']; ?>    </td>
                <td>
                <?php 
                    //debug($value['Right']['id']);

                    if($value['Right']['id'] == 2){
                        echo "Proprietaire";
                    }else
                    if($value['Right']['id'] == 3){
                        echo $this->Form->input('conditions', array('label' => "Add Item", 'type' => 'checkbox', 'checked' => 'checked','disabled' => $disabled));
                    }else
                    if($value['Right']['id'] == 4){
                        echo $this->Form->input('conditions', array('label' => "Add Member", 'type' => 'checkbox', 'checked' => 'checked','disabled' => $disabled));
                    }else
                    if($value['Right']['id'] == 5){

                        echo $this->Form->input('conditions', array('label' => "Add Item", 'type' => 'checkbox', 'checked' => 'checked','disabled' => $disabled));
                        echo "<td>";
                        echo $this->Form->input('conditions', array('label' => "Add Member", 'type' => 'checkbox', 'checked' => 'checked','disabled' => $disabled));
                        echo "</td>";
                    }
                    ?>
                </td>
                <br>
    		 	
    		</tr>
        <?php }
        echo "</table>";
        ?>
        
        <?php echo $this->Html->script('show_membersCtrler') ?>
<div id="members" ng-app="Members" ng-controller="addMemberController" ng-init="list_id=<?php echo $list['id'] ?>" >
        <div class="dropdown" ng-controller="addMemberController" align="left">
            <div class="dropup">
                <button  ng-click="ajouterMembre(<?php echo $idToDo; ?>)" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <div bind-unsafe-html="pageTest">
                        
                    </div>

                </ul>
            </div>
        </div>

        <div class="dropdown dropdown-right" ng-controller="addMemberController" align="right">
            <div class="dropup">
                <button  id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <div bind-unsafe-html="pageTest">
                        TEST
                    </div>

                </ul>
            </div>
        </div>
</div>