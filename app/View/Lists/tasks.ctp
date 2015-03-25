<h2><?php echo $list['Liste']['name'] ?> - <?php echo $list['Liste']['created'] ?></h2>

<?php debug($list) ?>

<div ng-app="Tasks" ng-controller="tasksController">

	<ul class="list-group" ng-model="tasks" ng-init="
			list=<?php echo htmlentities(json_encode($list)) ?>
			">

		<li class="list-group-item" ng-repeat="(key, value) in list.Task">
			<button class="list-group-item"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
			<ul>
				<li>{{value.name}}</li>
				<li>Utilisateur1</li>
			</ul>
		</li>
	</ul>

</div>

<?php echo $this->Html->script('tasksCtrler') ?>