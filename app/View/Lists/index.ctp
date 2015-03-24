<div ng-app="Liste" ng-controller="ListeController">
	<h1>c'est la liste des lists</h1>
	<?php //debug($lists) ?>

	<table class="table table-hover" ng-model="lists" ng-init="
			lists=<?php echo htmlentities(json_encode($lists)) ?>
			">
		<thead>
			<th>name</th>
			<th>description</th>
			<th>frequance</th>
			<th>date d'expiration</th>
			<th>date de creation</th>
			<th></th>
		</thead>
		<tbody>
			<tr ng-repeat="(key, value) in lists">
				<td>{{value.Liste.name}}</td>
				<td>{{value.Liste.description}}</td>
				<td>{{value.Liste.frequancy}}</td>
				<td>{{value.Liste.expirationDate}}</td>
				<td>{{value.Liste.created}}</td>
				<td><a href="lists/tasks/{{value.Liste.id}}" class="btn btn-default">Voir</a></td>
			</tr>
		</tbody>
	</table>

</div>
<script type="text/javascript">
	
</script>
<?php echo $this->Html->script('liste') ?>