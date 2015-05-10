<?php debug($users) ?>


<div ng-app="Member">
	<table class="table" ng-controller="memberController">
		<tbody ng-init="members=<?php echo htmlentities(json_encode($users)) ?>">
				<tr ng-repeat="(key, value) in members" >
					<th>{{value.User.username}}</th>
					<th><input type="checkbox" name="owner" ng-name="owner{{value.User.id}}" ng-checked="value.Member.right_id == 2" ng-click="rightOwner(key)"></th>
					<th><input type="checkbox" name="item" ng-name="item{{value.User.id}}" ng-checked="value.Member.right_id == 3" ng-click="rightItem(key)"></th>
					<th><input type="checkbox" name="user" ng-name="users{{value.User.id}}" ng-checked="value.Member.right_id == 4" ng-click="rightUser(key)"></th>
				</tr>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	var userId = <?php  echo AuthComponent::user('id'); ?>;
</script> 

<?php echo $this->Html->script('memberCtrler') ?>