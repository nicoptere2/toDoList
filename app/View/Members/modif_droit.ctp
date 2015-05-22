<div id="membres" ng-app="Member">
	<table class="table" ng-controller="memberController">
		<tbody>
			<?php $i=0; ?>
			<?php foreach ($users as $key => $value): ?>
				<tr>
					<th><?php echo $value['User']['username'] ?></th>
					<?php if ($value['Right']['id']==2): ?>
						<td>Proprietaire</td>
						<td></td>
					<?php else: ?>
						<th>
							<label>
								<input 
									type="checkbox"
									name="item<?php echo $i; ?>"
									data-ng-init="item<?php echo $i ?>=<?php echo ($value['Right']['item'])? 'true': 'false'; ?>"
									ng-model="item<?php echo $i ?>" 
									ng-checked="item<?php echo $i ?>"
									ng-click="itemClick(<?php echo $value['User']['id']?>, <?php echo $value['ToDo']['id'] ?>) "
									<?php echo ($ownerShip)? '' : 'disabled' ?>
								>
								Add Item
							</label>
						</th>
						<th>
							<label>
								<input
									type="checkbox"
									name="user<?php echo $i; ?>"
									data-ng-init="user<?php echo $i ?>=<?php echo ($value['Right']['user'])? 'true': 'false'; ?>"
									ng-model="user<?php echo $i ?>" 
									ng-checked="user<?php echo $i ?>"
									ng-click="userClick(<?php echo $value['User']['id']?>, <?php echo $value['ToDo']['id'] ?>) "
									<?php echo ($ownerShip)? '' : 'disabled' ?>
								>
								Add User
							</label>
						</th>
					<?php endif ?>
				</tr>
				<?php $i++; ?>
			<?php endforeach ?>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	var userId = <?php  echo AuthComponent::user('id'); ?>;
</script> 

<?php echo $this->Html->script('memberCtrler') ?>