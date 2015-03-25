<h2><?php echo $list['Liste']['name'] ?> - <?php echo $list['Liste']['created'] ?></h2>

<?php debug($list) ?>

<div id="tasks" ng-app="Tasks" ng-controller="tasksController">

	<ul class="list-group" ng-model="tasks" ng-init="
			list=<?php echo htmlentities(json_encode($list)) ?>
			">

		<li class="list-group-item" ng-repeat="(key, value) in list.Task">
			<button><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
			<div class="task">
				<div class="task-name">{{value.name}}</div>
				<div class="task-user"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>Utilisateur1</div>
			</div>
		</li>
	</ul>

</div>

<?php echo $this->Html->script('tasksCtrler') ?>