<div ng-app="Liste" ng-controller="ListeController">
	<h1>c'est la liste des lists</h1>
	<?php //debug($lists) ?>
	 {{remaining}} 

	<table class="table table-hover">
		<thead>
			<th>name</th>
			<th>description</th>
			<th>frequance</th>
			<th>date d'expiration</th>
			<th>date de creation</th>
			<th></th>
		</thead>
		<tbody>
			<?php foreach ($lists as $key => $value): ?>
				<tr>
					<td><?php echo $value['Liste']['name'] ?></td>
					<td><?php echo $value['Liste']['description'] ?></td>
					<td><?php echo $value['Liste']['frequancy'] ?></td>
					<td><?php echo $value['Liste']['expirationDate'] ?></td>
					<td><?php echo $value['Liste']['created'] ?></td>
					<td>
						<?php echo $this->Html->link('voir',
										array(
											'controller' => 'Lists',
											'action' => 'tasks',
											$value['Liste']['id']
											),
										array(
											'class' => 'btn btn-default'
											)
										)
						?>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

</div>
<?php echo $this->Html->script('liste') ?>