<h3>Liste d'amis</h3>
<div ng-app="Friend">
    <table class="table" ng-controller="friendController">
        <thead>
            <tr>
                <th>Username</th>
            </tr>
        </thead>
        <tbody ng-init="tableau=<?php echo htmlentities(json_encode($tableau)) ?>">
           <tr ng-repeat="(key, value) in tableau" >
                <td>{{value}}</td>
            </tr>
        </tbody>
    </table>

    
    <div class="dropdown" ng-controller="addFriendController" align="right">
      <div class="dropup">
        <button ng-click="ajouterAmi()" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
          <div bind-unsafe-html="pageTest">

          </div>

        </ul>
      </div>
    </div>

        <?php
        echo $this->Html->link('supprimer des amis', array('controller' => 'Friends',
                                                  'action' => 'del_friends',
                                                  ));

    ?>
</div>

<?php echo $this->Html->script('friendsCtrler') ?>