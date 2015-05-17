<?php debug($users) ?>


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
								<input type="checkbox" name="item" ng-model="item<?php echo $i +"=" + ($value['Right']['item'])? 'checked' : '' ?>" >
								Add Item
							</label>
						</th>
						<th>
							<label>
								<input type="checkbox" name="user" <?php echo ($value['Right']['user'])? 'checked' : ''  ?> >
								Add User
							</label>
						</th>
					<?php endif ?>
				</tr>
			<?php endforeach ?>
		</tbody>
		{{item1}}
	</table>
</div>

<script type="text/javascript">
	var userId = <?php  echo AuthComponent::user('id'); ?>;
</script> 

<?php echo $this->Html->script('memberCtrler') ?>