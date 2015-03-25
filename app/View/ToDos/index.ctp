<div id="lists" ng-app="Liste" ng-controller="listeController">

	<div class="list-group" ng-model="toDos" ng-init="
			toDos=<?php echo htmlentities(json_encode($toDos)) ?>
			">

		<a href="toDos/tasks/{{value.id}}" class="list-group-item" ng-repeat="(key, value) in toDos">
				<span class="name">{{value.name}}</span> -
				<span class="created">{{value.created}}</span>
				<button class="btn-delete"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
		</a>
	
	</div>
	<button class="btn btn-default" ng-Click="listRefresh()">Refresh</button>

</div>


<script type="text/javascript">
	
</script>
<?php echo $this->Html->script('listeCtrler') ?>