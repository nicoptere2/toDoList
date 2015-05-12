<div id="lists" ng-app="Liste" ng-controller="listeController">
	<div class="liste-group" ng-model="toDos" ng-init="
			toDos=<?php echo htmlentities(json_encode($toDos)) ?>
			">

		<div class="list" ng-repeat="(key, value) in toDos">

			<a href="ToDos/tasks/{{value.id}}" class="liste-item" >
					<span class="name">{{value.name}}</span> -
					<span class="expirationDate" ng-model="expirationDate"> {{dateHelper(value.expirationDate);}} </span>
			</a>
			<a href="{{base}}ToDos/edit/{{value.id}}" class="btn-edit bouton"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
			<a href="{{base}}ToDos/delete_todos/{{value.id}}" class="btn-delete bouton" onclick="return confirm('Voulez-Vous supprimer cette liste ?\n Cette action est irreversible.')"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></a>
		</div>
	
	</div>
	<a ng-href="{{base}}ToDos/create" class="bouton btn-add"><span class="glyphicon glyphicon-plus"></span></a>
</div>


<script type="text/javascript">
	
</script>
<?php echo $this->Html->script('dateHelper') ?>
<?php echo $this->Html->script('listeCtrler') ?>