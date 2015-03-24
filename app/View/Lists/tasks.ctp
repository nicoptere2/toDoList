<h1>la liste des tache d'une liste</h1>

<table class="table table-hover">
	<thead>
		<th>#</th>
		<th>tache</th>
		<th>quantité</th>
		<th>date de création</th>
	</thead>
	<tbody>
		<?php $i=1; ?>
		<?php foreach ($list['Task'] as $key => $value): ?>
			<tr>
				<td><?php echo $i; $i++; ?></td>
				<td><?php echo $value['name'] ?></td>
				<td><?php echo $value['quantity'] ?></td>
				<td><?php echo $value['created'] ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>