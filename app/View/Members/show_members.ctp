
<h3>Utilisateurs de la liste</h3>
<div ng-app="Member">
    <table class="table" ng-controller="memberController">
        <thead>
            <tr>
                <th>Username</th>
                <th>Modification d'item</th>
                <th>Modification d'utilisateur</th>
            </tr>
        </thead>
        <tbody ng-init="members=<?php echo htmlentities(json_encode($members)) ?>">
           <tr ng-repeat="(key, value) in members" >
                <td>{{value.User.username}}</td>
                <td compile-data template="{{rightsItem(key)}}"></td>
                <td compile-data template="{{rightsUser(key)}}"></td>
            </tr>
        </tbody>
    </table>
</div>
        
        <?php echo $this->Html->script('show_membersCtrler') ?>
    <div id="members" ng-app="Members" ng-controller="addMemberController" ng-init="list_id=<?php echo $list['id'] ?>" >
    <?php echo "<table style=\"width:100%\">"; ?>
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
        </td>
    </tr>
    <?php
        echo "</table>";
    ?>
    </div>

<script type="text/javascript">
    var userId = <?php  echo AuthComponent::user('id'); ?>;
</script> 
<?php echo $this->Html->script('memberCtrler') ?>