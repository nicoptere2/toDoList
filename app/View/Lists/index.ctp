<h2>c'est la liste des lists</h2>
<div ng-app="Liste" ng-controller="listeController">

	<div class="list-group lists" ng-model="lists" ng-init="
			lists=<?php echo htmlentities(json_encode($lists)) ?>
			">

		<a href="lists/tasks/{{value.Liste.id}}" class="list-group-item" ng-repeat="(key, value) in lists">
			<ul>
				<li>{{value.Liste.name}}</li>
				<li>{{value.Liste.created}}</li>
			</ul>
		</a>
	
	</div>
	<button class="btn btn-default" ng-Click="listRefresh()">Refresh</button>

</div>


<script type="text/javascript">
	
</script>
<?php echo $this->Html->script('listeCtrler') ?>