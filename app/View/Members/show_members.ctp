<div id="tasks" ng-app="Tasks">
    <table class="table" ng-controller="memberController">
        <tbody>
            <?php $i=0; ?>
            <?php foreach ($users as $key => $value): ?>
                <tr>
                    <th><?php echo $value['User']['username'] ?></th>
                    <?php if ($value['Right']['id']==2): ?>
                        <td>Proprietaire</td>
                        <td></td>
                    <?php else: ?>
                        <th>
                            <label>
                                <input 
                                    type="checkbox"
                                    name="item<?php echo $i; ?>"
                                    data-ng-init="item<?php echo $i ?>=<?php echo ($value['Right']['item'])? 'true': 'false'; ?>"
                                    ng-model="item<?php echo $i ?>" 
                                    ng-checked="item<?php echo $i ?>"
                                    ng-click="itemClick(<?php echo $value['User']['id']?>, <?php echo $value['ToDo']['id'] ?>) "
                                    <?php echo ($ownerShip)? '' : 'disabled' ?>
                                >
                                Add Item
                            </label>
                        </th>
                        <th>
                            <label>
                                <input
                                    type="checkbox"
                                    name="user<?php echo $i; ?>"
                                    data-ng-init="user<?php echo $i ?>=<?php echo ($value['Right']['user'])? 'true': 'false'; ?>"
                                    ng-model="user<?php echo $i ?>" 
                                    ng-checked="user<?php echo $i ?>"
                                    ng-click="userClick(<?php echo $value['User']['id']?>, <?php echo $value['ToDo']['id'] ?>) "
                                    <?php echo ($ownerShip)? '' : 'disabled' ?>
                                >
                                Add User
                            </label>
                        </th>
                    <?php endif ?>
                </tr>
                <?php $i++; ?>
            <?php endforeach ?>
        </tbody>
    </table>
        
    <div id="tasks" ng-controller="addMemberController" ng-init="list_id=<?php echo $list['id'] ?>" >
        <table style="width:100%">
            <tr>
                <td>
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
                </td>
                <td>

                    <div class="dropdown dropdown-right" ng-controller="delMemberController" align="right">
                        <div class="dropup">
                            <button  ng-click="supprimerMembre(<?php echo $idToDo; ?>)" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            <?php if($ownerShip == false){
                                echo "disabled";
                                }?>
                            >
                                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <div bind-unsafe-html="pageTest">
                                    TEST
                                </div>


                            </ul>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

<script type="text/javascript">
    var userId = <?php  echo AuthComponent::user('id'); ?>;
</script> 
<?php echo $this->Html->script('tasksCtrler') ?>