<div ng-app="Liste" ng-controller="ListeController">
	<h1>c'est la liste des lists</h1>

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

</div>
<script type="text/javascript">
	
</script>
<?php echo $this->Html->script('liste') ?>