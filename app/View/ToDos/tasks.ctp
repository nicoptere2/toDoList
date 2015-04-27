<?php debug($tasks) ?>

<div id="tasks" ng-app="Tasks" ng-controller="tasksController" ng-init="list_id=<?php echo $list['id'] ?>" >
	<h2><?php echo $list['name'] ?> - <?php echo $list['created'] ?></h2>

	<ul class="list-group" ng-model="tasks" ng-init="
			tasks=<?php echo htmlentities(json_encode($tasks)) ?>
			">
		<li class="list-group-item item"
			ng-repeat="(key, value) in tasks" 
			ng-class="
				{
					taskCompleted : value.Task.completed,
					taskHalf : value.Task.half,
					taskEmpty : value.Task.empty
				}"
			ng-model="value"
			ng-click=""
		>
			{{qteCompleted = value.Task.qteCompleted; ""}}
			{{qte = value.Task.quantity; ""}}

			<label class="checked">
				<input 
					type="checkbox" 
					ng-name="value.Task.id"
					ng-model="value.value"
					ng-checked="value.Task.completed"
					ng-change="boxClick(key)"
				>
				<div class="task">
					<div class="task-name">{{value.Task.name}}</div>
					<div class="task-user" ng-repeat="(user_key, checked) in value.Checked" >
						<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>{{checked.User.username}} : {{checked.quantity}} sur {{value.Task.quantity}}
					</div>
				</div>

				<input 
					type="number"
					name="quantity" 
					ng-model="value.quantity"
					ng-show="value.Task.quantitatif && !value.Task.completed"
					placeholder="quantité"
				>

				<div class="quantity">
					<div>
						<div class="progress">
							<div class="progress-bar" role="progressbar" aria-valuenow="{{qteCompleted / qte * 100}}" aria-valuemin="0" aria-valuemax="100" style="width: {{qteCompleted / qte * 100}}%;">
								{{qteCompleted / qte * 100}}%
							</div>
						</div>
					</div>
					<span>{{qteCompleted}} / {{qte}}</span>
				</div>
                        </label>
                    <?php  
                    $user_id = AuthComponent::user('id'); 
                        echo $this->Html->link('supprimer l\'éléments', '/Tasks/delete_task/'.$idToDo.'/{{value.Task.id}}'
                                                );
                    ?>
		</li>
	</ul>
</div>

<?php echo $this->Html->script('dateHelper') ?>
<?php echo $this->Html->script('tasksCtrler') ?>
<?php  $user_id = AuthComponent::user('id'); 
        
        echo $this->Html->link('ajouter des éléments', array('controller' => 'Tasks',
                                                  'action' => 'add_task',$idToDo
                                                  ));
        ?>
