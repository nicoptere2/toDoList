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