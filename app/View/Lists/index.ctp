<div id="lists" ng-app="Liste" ng-controller="listeController">

	<div class="list-group" ng-model="lists" ng-init="
			lists=<?php echo htmlentities(json_encode($lists)) ?>
			">

		<a href="lists/tasks/{{value.Liste.id}}" class="list-group-item" ng-repeat="(key, value) in lists">
				<span class="name">{{value.Liste.name}}</span> -
				<span class="created">{{value.Liste.created}}</span>
				<button class="btn-delete"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
		</a>
	
	</div>
	<button class="btn btn-default" ng-Click="listRefresh()">Refresh</button>

</div>


<script type="text/javascript">
	
</script>
<?php echo $this->Html->script('listeCtrler') ?>