<div id="tasks" ng-app="Tasks" ng-controller="tasksController" ng-init="list_id=<?php echo $list['id'] ?>" >
	<h2><?php echo $list['name'] ?> - <span class="created"> <?php echo $this->Date->date($list['created']) ?> </span></h2>
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
					class="checkbox"
					ng-name="value.Task.id"
					ng-model="value.checkBoxValue"
					ng-checked="value.Task.completed"
					ng-click="boxClick(key)"
				>

				<span class="rounded"> <span class="glyphicon glyphicon-ok tick" ng-show="value.Task.completed"></span> </span>


				<div class="task-content">
					<div class="task">
						<div class="task-name">{{value.Task.name}}</div>
						<div class="task-user" ng-repeat="(user_key, checked) in value.Checked" >
							<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>{{checked.User.username}} : {{checked.quantity}} sur {{value.Task.quantity}}
						</div>
					</div>
					
					<form action="#" ng-submit="boxClick(key)">
						<input 
							type="number"
							name="quantity" 
							ng-model="value.quantity"
							ng-show="value.Task.quantitatif && !value.Task.completed"
							placeholder="quantité"
							ng-blur="boxClick(key)"
						>
					</form>

					<div class="quantity" ng-show="value.Task.half">
						<div>
							<div class="progress">
								<div class="progress-bar" role="progressbar" aria-valuenow="{{qteCompleted / qte * 100}}" aria-valuemin="0" aria-valuemax="100" style="width: {{qteCompleted / qte * 100}}%;">
									{{qteCompleted / qte * 100}}%
								</div>
							</div>
						</div>
						<span>{{qteCompleted}} / {{qte}}</span>
					</div>
				</div>

                                <a ng-href="{{base}}/Tasks/delete_task/<?php echo $idToDo ?>/{{value.Task.id}}" class="btn-delete" onclick="return confirm('Voulez-Vous supprimer l\'élément {{value.Task.id}} ?\n Cette action est irreversible.')">
					<span class="glyphicon glyphicon-minus"></span>
				</a>
            </label>
		</li>
	</ul>

    <div class="dropdown" ng-controller="addMemberController" align="right">
    	<div class="dropup">
    		<button ng-click="ajouterMembre(<?php echo $idToDo; ?>)" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    			<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
    		</button>
    		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
    			<div bind-unsafe-html="pageTest">

    			</div>

    		</ul>
    	</div>
    </div>

<?php echo $this->Html->script('dateHelper') ?>
<?php echo $this->Html->script('tasksCtrler') ?>
<script type="text/javascript">
	var userId = <?php  echo AuthComponent::user('id'); ?>;
</script> 	
        <?php
        echo $this->Html->link('ajouter des éléments', array('controller' => 'Tasks',
                                                  'action' => 'add_task',$idToDo
                                                  ));
        ?>
</div>
