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
</div>

<?php echo $this->Html->script('friendsCtrler') ?>