<div id="lists" ng-app="Liste" ng-controller="listeController">
	<a href="ToDos/create"><button><span class="glyphicon glyphicon-plus"></span></button></a>
	<div class="list-group" ng-model="toDos" ng-init="
			toDos=<?php echo htmlentities(json_encode($toDos)) ?>
			">

		<a href="ToDos/tasks/{{value.id}}" class="list-group-item" ng-repeat="(key, value) in toDos">
				<span class="name">{{value.name}}</span> -
				<span class="created" ng-model="created"> {{dateHelper(value.expirationDate);}} </span>
				<button class="btn-delete"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
		</a>
	
	</div>
</div>


<script type="text/javascript">
	
</script>
<?php echo $this->Html->script('dateHelper') ?>
<?php echo $this->Html->script('listeCtrler') ?>