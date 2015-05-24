<h3>Liste d'amis</h3>
<div id="friends" ng-app="Friend" ng-controller="friendController">
    <table class="table">
        <thead>
            <tr>
                <th>Username</th>
            </tr>
        </thead>
        <?php if($tableau != null){ ?>
        <tbody ng-init="tableau=<?php echo htmlentities(json_encode($tableau)) ?>">
           <tr ng-repeat="(key, value) in tableau" >
                <td>{{value}}</td>
            </tr>
        </tbody>
        <?php } ?>
    </table>

    <div class="dropdown dropdown-right" ng-controller="addFriendController" align="right">
      <div class="dropup">
        <button ng-click="ajouterAmi()" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
          <div bind-unsafe-html="pageTest">
          TEST
          </div>

        </ul>
      </div>
    </div>

    <?php
        echo $this->Html->link('ajouter des amis', array('controller' => 'Friends',
                                                  'action' => 'add_friends',
                                                  ));
        echo "\n";
        
        echo $this->Html->link('supprimer des amis', array('controller' => 'Friends',
                                                  'action' => 'del_friends',
                                                  ));

    ?>
</div>

<?php echo $this->Html->script('friendsCtrler') ?>