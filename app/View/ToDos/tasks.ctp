<h2><?php echo $list['name'] ?> - <?php echo $list['created'] ?></h2>
<div ng-app="Tasks">
<div id="tasks" ng-controller="tasksController" ng-init="list_id=<?php echo $list['id'] ?>" >
	<ul class="list-group" ng-model="tasks" ng-init="
			tasks=<?php echo htmlentities(json_encode($tasks)) ?>
			">
		<li class="list-group-item item" ng-repeat="(key, value) in tasks">
			{{qteCompleted = value.Task.qteCompleted; ""}}
			{{qte = value.Task.quantity; ""}}
			<label for="checked" class="checked">
				<input type="checkbox" ng-model="value.Task.completed" ng-name="value.Task.id">
				<span class="tick"></span>
				<div class="task">
					<div class="task-name">{{value.Task.name}}</div>
					<div class="task-user" ng-repeat="(user_key, checked) in value.Checked" >
						<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>{{checked.User.username}} : {{checked.quantity}} sur {{value.Task.quantity}}
					</div>
				</div>
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

<?php echo $this->Html->script('tasksCtrler') ?>

<?php  $user_id = AuthComponent::user('id'); 
        
        echo $this->Html->link('ajouter des éléments', array('controller' => 'Tasks',
                                                  'action' => 'add_task',$idToDo
                                                  ));
        ?>

<<<<<<< HEAD
<div class="dropup" align="right">
  <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  	<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
  </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
    <?php echo $this->elements('Members/add_member'); ?>
  </ul>
</div>

=======
<div class="dropdown" ng-controller="addMemberController" align="right">
<div class="dropup">
  <button ng-click="ajouterMembre()" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
  </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
   	<div bind-unsafe-html="pageTest">
   		
   	</div>
    
  </ul>
</div>
</div>

<!--
<div align="right">
>>>>>>> b34c4dc1176465e23aaf77ce4c33c7ea1080753d
<?php  $user_id = AuthComponent::user('id'); 
        
        echo $this->Html->link('ajouter des membres', array('controller' => 'Members',
                                                  'action' => 'add_member',$idToDo
                                                  ));
        ?>
</div>
-->

</div>
